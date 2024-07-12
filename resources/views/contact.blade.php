<x-user-layout>
  
  
              <!-- Hero Section -->
              <div class="position-relative bg-body-tertiary " style="min-height: 70vh;width:100vw">
                <div class="overlay position-absolute w-100 h-100 start-0 top-0" style="background: linear-gradient(135deg, rgba(149, 209, 58, 0.6), rgba(128, 0, 128, 0.6)); z-index: 1;"></div>
                <div class="position-relative w-100 h-100 d-flex align-items-center" style="z-index: 2;">
                    <div class="row w-100  h-100">

                        <div class="col-12 col-lg-6 col-md-6 d-flex flex-column justify-content-center align-items-center py-5 h-100">
                            <div>
                                <h1 class=" text-center">Get in touch</h1>
                                <p>Want to get in touch? We'd love to hear from you. Here's how you can reach us.</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-md-6 d-flex justify-content-center align-items-center py-5 h-100">
                            <img class="img-fluid" src="{{asset('Storage/contact/contact.jpg')}}" alt="contact us" style="height:400px;width:400px; border-radius: 51% 49% 81% 19% / 79% 54% 46% 21% ;">
                        </div>
                        
                    </div>
                </div>
             </div>
            <!-- Hero Section ends--> 

            <div class="row ">
                <div class="position-relative  d-flex " style="height: 70vh">
                    <div class="col-12 position-absolute d-flex justify-content-around" style="z-index: 3; top:-40px">
                        <div class="col-lg-4 " >
                            <div class="card shadow contact-details p-5">
                                <h2 class="mb-4">Contact Information</h2>
                                <p>Have questions, suggestions, or feedback? We'd love to hear from you!</p>
                                <ul class="list-unstyled">
                                    <li>Email: <a href="mailto:contact@codingdiary.com">contact@codingdiary.com</a></li>
                                    <li>Address: 54 Brisbane City QLD 4000</li>
                                    <li>Phone: 0404243454</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card shadow contact-form p-5">
                                <h2 class="mb-4">Get In Touch</h2>
                                <form action="#" method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Your Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </form>
                            </div>
                        </div>
                       </div>
                </div>
               
               
               
            </div>
    



</x-user-layout>
