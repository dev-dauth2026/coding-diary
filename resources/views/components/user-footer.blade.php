<footer class=" footer-section position-relative   text-white  w-100" >
    <div class="container-fluid m-0 p-0 ">
        <div class="p-5 bg-dark " style="--bs-bg-opacity: .85; ">
            <div class="row " >
                <div class="col-md-4">
                    <h4>Know more about us</h4>
                    <p class="text-white text-opacity-50">Learn coding more effectively from Coding Diary blog.</p>
                </div>
                <div class="col-md-4">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-opacity-50">Home</a></li>
                        <li><a href="{{route('account.blog')}}" class="text-white text-opacity-50">Blogs</a></li>
                        <li><a href="{{route('account.about')}}" class="text-white text-opacity-50">About</a></li>
                        <li><a href="{{route('account.contact')}}" class="text-white text-opacity-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p class="text-white text-opacity-50">Email: {{$businessInformation->email}} </p>
                    <p class="text-white text-opacity-50">Address: {{$businessInformation->address}} </p>

                    <div class="mt-3">
                        <h4>Follow Us</h4>
                        <a href="{{$businessInformation->facebook_link}}" class="text-white text-opacity-50 mx-2">
                            <i class="bi bi-facebook" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="{{$businessInformation->youtube_link}}" class="text-white text-opacity-50 mx-2">
                            <i class="bi bi-youtube" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="{{$businessInformation->twitter_link}}" class="text-white text-opacity-50 mx-2">
                            <i class="bi bi-twitter" style="font-size: 1.5rem;"></i>
                        </a>
                        <a href="{{$businessInformation->instagram_link}}" class="text-white text-opacity-50 mx-2">
                            <i class="bi bi-instagram" style="font-size: 1.5rem;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

       
        <div class=" bg-dark p-3">
            <p class="mb-0 text-center">&copy; 2024 Coding Diary. All rights reserved.</p>
        </div>
    </div>
  

</footer> 