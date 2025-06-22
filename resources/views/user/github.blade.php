@extends('user.app')

@section('content')

            <div class="row" style="margin:10px">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">View Github Link</div>
                        </div>
                        <div class="card-body">
                           
                           <div class="row">
                                <div class="col-lg-9">
                                <div class="form-group">
                                <!-- <label for="email2">Github Link</label> -->
                                <input type="text" id="github" class="form-control" readonly id="email2" value="{{$github != null ? $github->link : 'No github link provided yet'}}" required name="link" placeholder="Enter Github Class Link">
                                <small style="color:red; font-weight:500">
                            
                                </div>
                                </div>
                                <div class="col-lg-3" style="margin-top: 10px;">
                                    <button id="btn_copy" class="btn btn-danger">copy link <i class="fa fa-copy"></i></button>
                                </div>
                           </div>
                        
                    </div>
                    
                </div>
            </div>

            <script>
            // / Get a reference to the input field and the copy button
            var inputField = document.getElementById("github");
            var copyButton = document.getElementById("btn_copy");

            // Attach an event listener to the copy button
            copyButton.addEventListener("click", function() {
            // Select the text within the input field
            inputField.select();

            // Copy the selected text to the clipboard
            document.execCommand("copy");

            // Show an alert to indicate that the text has been copied
            showErrorMessage("Github link has been copied");
            });
// In this example, the event listener is attached to the click event of the c

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


@endsection