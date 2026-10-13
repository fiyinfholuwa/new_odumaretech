<?php

namespace App\Services;

use App\Models\AppliedCourse;
use App\Models\Assignment;
use App\Models\FinalProject;
use App\Models\SubmitAssignment;
use App\Models\SubmitProject;
use Illuminate\Support\Collection;

class CourseCompletionService
{
    /**
     * Mark all pending enrollments complete when every required assessment is graded.
     *
     * Returns true when the course is complete after reconciliation.
     */
    public function sync(int|string $userId, int|string $courseId): bool
    {
        $application = AppliedCourse::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->latest('id')
            ->first();

        if (!$application) {
            return false;
        }

        $assignments = Assignment::where('course_id', $courseId)
            ->get()
            ->filter(fn (Assignment $assignment) => $this->belongsToCohort($assignment->cohort_id, $application->cohort_id));

        $projects = FinalProject::where('course_id', $courseId)
            ->get()
            ->filter(fn (FinalProject $project) => $this->belongsToCohort($project->cohort_id, $application->cohort_id));

        $submittedAssignments = SubmitAssignment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->get();

        $submittedProjects = SubmitProject::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->get();

        [$hasAssignmentRequirements, $assignmentsComplete] = $this->assessmentsComplete($assignments, $submittedAssignments);
        [$hasProjectRequirements, $projectsComplete] = $this->assessmentsComplete($projects, $submittedProjects);

        // External/curriculum-only courses have no assessment workflow and must
        // not be marked complete just because the certificate page was opened.
        if ((!$hasAssignmentRequirements && !$hasProjectRequirements)
            || !$assignmentsComplete
            || !$projectsComplete) {
            return false;
        }

        AppliedCourse::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('status', 'pending')
            ->update(['status' => 'completed']);

        return true;
    }

    /**
     * A course with no configured assessments does not become complete merely by
     * visiting the certificate page. If submissions exist, all of them must be graded.
     */
    private function assessmentsComplete(Collection $definitions, Collection $submissions): array
    {
        $requiredIds = $definitions->pluck('id')->map(fn ($id) => (string) $id);
        $submittedIds = $submissions->pluck('assessment_id')
            ->filter(fn ($id) => $id !== null && $id !== '')
            ->map(fn ($id) => (string) $id);
        $allIds = $requiredIds->merge($submittedIds)->unique()->values();

        if ($allIds->isEmpty()) {
            return [false, true];
        }

        $gradedIds = $submissions
            ->where('status', 'graded')
            ->pluck('assessment_id')
            ->filter(fn ($id) => $id !== null && $id !== '')
            ->map(fn ($id) => (string) $id)
            ->unique();

        return [true, $allIds->diff($gradedIds)->isEmpty()];
    }

    private function belongsToCohort($storedCohorts, $cohortId): bool
    {
        if ($storedCohorts === null || $storedCohorts === '' || $cohortId === null || $cohortId === '') {
            return true;
        }

        $decoded = json_decode((string) $storedCohorts, true);
        $cohorts = json_last_error() === JSON_ERROR_NONE
            ? (is_array($decoded) ? $decoded : [$decoded])
            : [$storedCohorts];

        return in_array((string) $cohortId, array_map('strval', $cohorts), true);
    }
}
