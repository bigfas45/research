<div class="section">
        <div class="container w-container">
            <div class="section-title-wrapper">
                <h2 class="section-title">Upcoming Events in Lagos</h2>
             
                <div class="section-title-divider"></div>
            </div>
            <div class="upcoming-events-list-wrapper w-dyn-list">
                <div class="w-dyn-items">
                   <?php foreach($sqlEvents->result() as $eventsRow){?>

                   
                    <div class="event-item w-dyn-item">
                        <a class="event-image-block w-inline-block" style="background-image: url('daks2k3a4ib2z.cloudfront.net/5724c55c9134bc281e3f6a7c/573ceb0e663360c6485bfa87_Photo-6.jpg');" href="events/emmanuel-nunes-viola-music.html">
                            <div class="event-date-block w-clearfix">
                                <div class="event-date-title">19</div>
                                <div class="event-date-title month">May</div>
                                <div class="event-date-title month">2016</div>
                            </div>
                        </a>
                        <div class="event-info-block"><a class="event-title-link" href="events/emmanuel-nunes-viola-music.html">Emmanuel Nunes: Viola Music</a>
                            <div class="event-info-wrapper">
                                <div class="course-info-icon"></div>
                                <div class="event-info-title">May 19, 2016</div>
                                <div class="course-info-icon"></div>
                                <div class="event-info-title">4:00 AM</div>
                                <div class="event-info-title">-</div>
                                <div class="event-info-title">7:00 PM</div>
                            </div>
                            <div class="event-info-wrapper">
                                <div class="course-info-icon"></div>
                                <div class="event-info-title">Amsterdam</div>
                            </div><a class="button events-learn-more w-button" href="events/emmanuel-nunes-viola-music.html">Learn more</a></div>
                    </div>
                   <?php } ?>
                  
                </div>
            </div>
            <div class="bottom-info-text">Want to see the full list of upcoming Events? <a href="events.html">View Full Events Overview →</a></div>
        </div>