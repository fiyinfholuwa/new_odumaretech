@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">View Recorded: <span style="color:red; font-weight:bold;">{{$course_title->title}}</span></div>
                        </div>

                        <div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>S/N</th>
													<th>Course</th>
                                                    <th>Recorded Link</th>
                                                    <th>Action</th>
												</tr>
											</thead>
											
                                            <tbody>
											<?php $i = 1; ?>
                                            @foreach($records as $record)
                                           
											<tr>
												<td>{{$i++;}}</td>
                                                <td>{{optional($record->course_name)->title}}</td>
                                                <td><div class="form-group">
                                <!-- <label for="email2">Github Link</label> -->
                                                <input type="text" id="text-input" class="form-control text-input" readonly  value="{{$record != null ? $record->link : 'No Recorded Session link provided yet'}}">
                                                <small style="color:red; font-weight:500">
                                                </div>
                                                </td>
                                                <td>
                                                
                                                    <button id="copy-button" class="btn btn-danger copy-button">copy link <i class="fa fa-copy"></i></button>
                                        
                                                </td>
                                            
											</tr>
											
                                            @endforeach
                                    
                                            </tbody>
										</table>
									</div>
								</div>
                </div>
            </div>

            <script>
            
            function showErrorMessage(message) {
            // Get the error message element
            var errorMessageElement = document.getElementById("errorMessage");

            // Set the error message content
            errorMessageElement.textContent = message;

            // Trigger the modal to show
            var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
            errorModal.show();
            }
            </script>

        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="errorModalLabel">Error Message</h5> -->
                <!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <div style="color:green; font-weight:700;" class="alert alert-success" role="alert" id="errorMessage">
                <!-- Error message content goes here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>



        


    <script>
        // Get all copy buttons and text inputs
        const copyButtons = document.querySelectorAll(".copy-button");
        const textInputs = document.querySelectorAll(".text-input");
        const modal = document.getElementById("myModal");
        const modalContent = document.querySelector(".modal-content");
        const copiedText = document.getElementById("copiedText");

        // Add click event listeners to each copy button
        copyButtons.forEach((button, index) => {
            button.addEventListener("click", () => {
                // Copy the text from the corresponding input
                const textToCopy = textInputs[index].value;

                // Create a temporary textarea to copy the text
                const tempTextarea = document.createElement("textarea");
                tempTextarea.value = textToCopy;
                document.body.appendChild(tempTextarea);
                tempTextarea.select();
                document.execCommand("copy");
                document.body.removeChild(tempTextarea);
                showErrorMessage("Recorded Session link has been copied");
            });
        });

        // Close the modal when the user clicks the close button
        const closeButton = document.querySelector(".close");
        closeButton.addEventListener("click", () => {
            modal.style.display = "none";
        });
    </script>
        

@endsection