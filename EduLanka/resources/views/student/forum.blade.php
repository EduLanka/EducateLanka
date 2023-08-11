@extends('layouts.studentLayout')
@section('content')
<p><b>FORUMS</b></p>
<div class="forum-container">
    <div class="forum-nav">
        <button type="button" class="forum-btn" data-bs-toggle="modal" data-bs-target="#staticBackdropAdd">
            Add New <i class="bx bx-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create New Forum</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create-forum') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--form start -->

                    <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" class="form-control" name="description" rows="4" cols="50"></textarea>
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

        <br>
        <br>
        <p><b>ALL FORUMS</b></p>
        @foreach($forums as $forum)
        <button class="forum-button"  data-forum-id="{{$forum->id}}">{{$forum->title}}</button>
        
        <br>
        <br>
        @endforeach
    </div>
    <div class="forum-view">
       
        <h3 class="forum-title" id="selected-forum-title"></h3>
        <br>
        <p class="forum-description" id="selected-forum-description"></p>
        <p class="creator-details" id="creator-details"><i class="bx bx-calendar"></i> Created by User<span id="selected-forum-creator"></span> on <span id="selected-forum-date"></span></p>
        <p class="nposts" id="nposts"><i class="bx bx-chat"></i><span id="selected-forum-posts"></span></p>


        <button type="button" class="btn-share" id="btn-share" data-bs-toggle="modal" data-bs-target="#staticBackdropShare">
            Share Post
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdropShare" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('share-post', ['forumId' => $forum->id]) }}"id="share-post-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!--form start -->
                    <input type="hidden" id="forum-id" name="forum_id">

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" class="form-control" name="description" rows="4" cols="50" required></textarea>
                    </div>  
                    
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="image"  name="image" accept=".png,.jpg,.jpeg">
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

        <hr>

        <div class="posts">

        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const forumButtons = document.querySelectorAll(".forum-button");
    const forumTitleElement = document.getElementById("selected-forum-title");
    const forumDescriptionElement = document.getElementById("selected-forum-description");
    const forumCreatorElement = document.getElementById("selected-forum-creator");
    const forumDateElement = document.getElementById("selected-forum-date");
    const forumPostsElement = document.getElementById("selected-forum-posts");
    const forumCreator = document.getElementById("creator-details");
    const forumPosts = document.getElementById("nposts");
    const btnShare = document.getElementById("btn-share");
    const postsContainer = document.querySelector(".posts"); 

    forumButtons.forEach(button => {
        button.addEventListener("click", async function () {
            const forumId = button.getAttribute("data-forum-id");
            const response = await fetch(`/forums/${forumId}`);
            const forumData = await response.json();

            forumCreator.style.display = "block";
            forumPosts.style.display = "block";
            btnShare.style.display = "block";

            forumTitleElement.textContent = forumData.title;
            forumDescriptionElement.textContent = forumData.description;
            forumCreatorElement.textContent = forumData.creator_id;
            forumDateElement.textContent = forumData.created_on;
            forumPostsElement.textContent = " " + forumData.num_posts + " post(s)";

            // Fetch and display posts
            const postsResponse = await fetch(`/forums/${forumId}/posts`);
            const postsData = await postsResponse.json();
            console.log(postsData);
            displayPosts(postsData); // Call the function to display posts
            updateFormAction(forumId);
        });
    });

    // Function to display posts
    function displayPosts(posts) {
        postsContainer.innerHTML = ""; // Clear previous posts

        posts.forEach(post => {
            const postElement = document.createElement("div");
            postElement.classList.add("post");
            postElement.innerHTML = `
                <div class="postup">
                <img class="post-user" src="{{ asset('assets/images/userImage.jpg') }}"/>
                <div class="postdown">
                <p><b>${post.user.name}</b></p> 
                <p><em>${post.uploaded_on}</em></p>
                </div>
                </div>
                <h3>${post.title}</h3>
                <img class="post-image" src="${post.image_url}" />             
                <p>${post.description}</p>
                <p><i class="bx bx-heart"></i>${post.num_likes}</p>
                
            `;

            postsContainer.appendChild(postElement);
        });
    }

    function updateFormAction(forumId) {
        const sharePostForm = document.getElementById("share-post-form");
        const newAction = sharePostForm.getAttribute("action").replace('{forumId}', forumId);
        sharePostForm.setAttribute("action", newAction);
        const forumIdInput = document.getElementById("forum-id");
        forumIdInput.value = forumId;
    }
});

</script>
@endsection
