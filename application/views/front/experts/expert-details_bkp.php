<? $this->load->view("front/includes/header");?>

<div id="inbanner">
<img src="<?php echo base_url();?>assets/images/front/counselor.jpg"   alt="" class="img-fluid">
</div>

<section id="ex">
  <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-img">
                            <img src="<?php echo base_url();?>assets/images/front/team-4-big.jpg" class="img-thumbnail img-fluid" alt=""/>
                            
                            
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="profile-head">
                                    <h5>
                                        Ajay Singh
                                    </h5>
                                    <h6>
                                        MBA Harvard, MS UT Austin, IIT Roorkee
                                    </h6>
                                    <p class="proile-rating">Palo Alto, California, United States</p>
                                    
                                    <input type="submit" class="btn btn-danger round_btns" name="btnAddMore" value="BOOK A SESSION"/>
                                    
                            
                        </div>
                    </div>
                    <div class="col-md-2">
                       
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-work">
                            <h3>Specialities</h3>
                            <ul>
                           <li> MBA Admission Consulting</li>
<li>College Admissions (UG)</li>
<li>Strategy & Consulting </li>
<li>Financial Services</li>
<li>Career Guidance </li>
<li>MS Counselling </li>
<li>Job Search Guidance </li>
<li>Product Management </li>
<li>Entrepreneurship </li>
<li>Study in USA
</li>
</ul>
                        </div>
                    </div>
                    <div class="col-md-9 cd">

                     
                     <h3>Biography</h3>
                                    <p>Ajay Singh is the Co-Founder and Chairman of Stoodnt, Inc. He graduated from Harvard with an M.B.A, M.S. in Computer Engg. from Univ. of Texas at Austin and B. Tech in E&C from I.I.T Roorkee. Ajay has counseled, guided, and mentored students to top engineering and business colleges such as Harvard, Stanford, U.T Austin, Texas A&M, UCLA, Purdue, U. of Washington at Seattle, Cambridge, ISB, IIT, etc.</p>
                        
                    


                    <br/>
                    <div class="row">
                    <div class="col-md-6"><button class="btn btn-block btn-primary" >30 Minute Session</button></div>
                     <div class="col-md-6"><button class="btn btn-block btn-primary" >60 Minute Session</button></div>
                    </div>
                     
                         <div class="row tm">
                    <div class="col-md-6"><h2>30-Minute Career Q&A </h2></div>
                     <div class="col-md-6"><h2><span>₹3,000</span></h2></div>
                    </div>  
                    <hr>
                    
                    <div class="session_booking row">
                  <div class="col-sm-6">
                     <h3 class="basic_m_tital">Book Your Session <span class="error">(All Timings are in IST)</span></h3>
                     <div class="calendar" id="calendar-app">
                        <div class="session_avt_time">
                           <div id="footer-date">
                              <ul class="session">
                                                                  <li class="active">20 Jun 2020 21:00</li>
                                                                  <li class="">20 Jun 2020 22:00</li>
                                                                  <li class="">21 Jun 2020 21:30</li>
                                                                  <li class="">21 Jun 2020 22:30</li>
                                                                  <li class="">27 Jun 2020 21:30</li>
                                                                  <li class="">27 Jun 2020 22:30</li>
                                                                  <li class="">28 Jun 2020 21:30</li>
                                                                  <li class="">28 Jun 2020 22:30</li>
                                                               </ul>
                           </div>
                        </div>
                        <p style="color:red; display:inline-block;">If the above timings don't work for you, please select the below option.</p>
                        <label class="switch-request-session">
                           <input id="30_min_request_session" name="request-session-ckeckbox" type="checkbox">
                           <span class="request-session-slider round"></span>
                        </label><strong style="margin-left: 10px;">Request Session Time</strong>
                        <br><br>
                        <p style="color:black;">Once you select Request Session Time, The Counselor will get back to you and fix a timing convenient for you.</p>
                     </div>
                     <br>
                  </div>
                  <div class="col-sm-6 moblie_p_info" id="30_min_session">
                     
      <h3 class="basic_m_tital">Please share what specific help are you looking for?</h3>
      <div class="form-group">
         <label for="email">Email Address*</label>
         <input type="email" class="form-control email">
         
      </div>
      <div class="form-group">
         <label for="name">Name*</label>
         <input type="name" class="form-control name">
        
      </div>
      <div class="form-group">
         <label for="phone">Phone Number*</label>
         <input type="phone" class="form-control phone">
        
      </div>
      <div class="form-group">
         <label for="comment">Description*</label>
         <textarea type="comment" class="form-control comment" rows="2"></textarea>
         
      </div>
      <div class="form-group">
         <label for="address">Address*</label>
         <textarea type="address" class="form-control address" rows="2"></textarea>
       
      </div>
      <div class="form-group">
         <button class="btn btn-danger round_btns book_now_sessions">Book now</button>
      </div>
                  </div>
               </div>          
                        
                    </div>
                </div>
            </form>           
        </div>
</section>


<? $this->load->view("front/includes/footer");?>