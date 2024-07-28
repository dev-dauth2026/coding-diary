<x-user-layout>
  

  
              <!-- Hero Section -->
              <div class="position-relative bg-body-tertiary " style="min-height: 150vh;width:100vw">
                @if (session('success'))
                <div>
                    <p class="bg-secondary-subtle p-2 text-success mt-3 mx-auto rounded">{{ session('success') }}</p>
                </div>
                 @endif
                <div class="overlay position-absolute w-100 h-100 start-0 top-0" style="background: linear-gradient(135deg, rgba(149, 209, 58, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;"></div>
                <div class="position-relative w-100  d-flex flex-column py-5" style="z-index: 2;">
                    <div class="d-flex  w-100 align-items-center">

                        <div class="col-12 col-md-6  d-flex flex-column justify-content-center align-items-center py-5 h-100">
                            <div class="d-flex flex-column justify-content-center align-items center">
                                <h1 class=" text-center mb-5">Contact Us</h1>
                                <p class="text-center">Want to get in touch?</p>
                                <p class="text-center"> We'd love to hear from you. Here's how you can reach us.</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6  d-md-flex d-none justify-content-center align-items-center py-5 h-100">
                            <img class="img-fluid" src="{{asset('Storage/contact/contact.jpg')}}" alt="contact us" style="height:400px;width:400px; border-radius: 51% 49% 81% 19% / 79% 54% 46% 21% ;">
                        </div>
                        
                    </div>
                    <div class=" position-relative " >
                        <div class=" position-absolute " style="height:300px;width:500px; top:-50px; right:0px; background: rgba(21, 196, 164, 0.2);z-inde:10; border-radius:50%;"></div>
                        <div class="row position-relative  d-flex justify-content-center " >
                            <div class=" shadow  col-11 position-absoluted d-flex flex-md-row flex-column justify-content-between rounded-md-5 rounded-3 py-md-0 py-5" style="background: rgba(255, 255, 255, 0.2);
                                border-radius: 16px;
                                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                                backdrop-filter: blur(8px);
                                -webkit-backdrop-filter: blur(8px);
                                border: 1px solid rgba(255, 255, 255, 0.3);">
                               
                                <div class="col-lg-5 col-12 " >
                                    <div class="  contact-details p-md-5 p-2 ">
                                        <h2 class="">Contact Information</h2>
                                        <hr class="col-6 mb-4 ">
                                        <p>Have questions, suggestions, or feedback? We'd love to hear from you!</p>
                                        <ul class="list-unstyled">
                                            <li>Email: <a href="mailto:contact@codingdiary.com">contact@codingdiary.com</a></li>
                                            <li>Address: 54 Brisbane City QLD 4000</li>
                                            <li>Phone: 0404243454</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="vr d-none d-md-flex bg-secondary my-auto rounded-pill" style="width: 3px; height:400px;"></div>
                             
                                <div class="col-lg-5 col-12  border-left border-info">
                                    <div class="  contact-form p-md-5 p-2">
                                        <h2 class="">Get In Touch</h2>
                                        <hr class="col-6 mb-4 ">
                                        <form action="{{route('account.contact')}}" method="POST">
                                            @csrf
        
                                                <input type="hidden" class="form-control" id="user_type" name="user_type" value="{{Auth::user()?'user':'guest'}}">
                                           
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Your Name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name')}}">
                                                @error('name')
                                                    <p class="invalid-feedback">{{$message}} </p>
                                                @enderror
                                                
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Your Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" >
                                                @error('email')
                                                    <p class="invalid-feedback">{{$message}} </p>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" value="{{old('messsage')}}">{{old('message')}}</textarea>
                                                @error('message')
                                                    <p class="invalid-feedback">{{$message}} </p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Send Message</button>
                                        </form>
                                    </div>
                                </div>
                               </div>
                        </div>
                       
                       
                       
                    </div>
                </div>
             </div>
            <!-- Hero Section ends--> 

           
    



</x-user-layout>
