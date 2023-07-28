@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('student Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <!--contact admin-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Contact Admin
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Share your thoughts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{ url('sendMessage') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <!--form start -->
                      <div class="mb-3">

                        <label for="topic" class="form-label">Reason of contact</label>

                        <select name="topic" id="topic" class="form-control">
                          <option value="Ask a question" class="form-control" name="topic">Ask a question</option>
                          <option value="Leave a comment" class="form-control" name="topic">Leave a comment</option>
                          <option value="Report a bug" class="form-control" name="topic">Report a bug</option>
                          <option value="Suggest an improvement" class="form-control" name="topic">Suggest an improvement</option>
                          <option value="other" class="form-control" name="topic">Other</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                      </div>
                              <!-- end of form -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--End of modal-->


            <!--change password-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
              Change Password
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form method="POST" action="{{ url('changePassword',['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <!--form start -->

                      <div class="mb-3">
                        <label for="oldpw" class="form-label">Old Password</label>
                        <input id="oldPassword" type="password" class="form-control" name = "oldpw" placeholder="Enter your old password">
                        <p id="confirmOldPassword" style="color: red; display: none;">Incorrect password</p>
                      </div>
                      
                      <div class="mb-3">
                        <label for="newpw" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="psw" name="newpw" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter a password that meets the criteria">
                      </div>
                      <div id="criteria">
                        New password must contain the following:
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="specialChar" class="invalid">A <b>special character</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                      </div>
                      <div class="mb-3">
                          <label for="cpw" class="form-label">Confirm New Password</label>
                          <input type="password" class="form-control" name="cpw" id="confirmPassword" placeholder="Re-enter new password">
                          <p id="confirmErrorMessage" style="color: red; display: none;">Passwords do not match</p>
                      </div>

                      
                      <!-- end of form -->

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--End of modal-->


        </div>
      </div>
    </div>
@endsection