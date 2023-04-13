<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/cont.css" />
    
</head>
<body>
<div class="contact">

    
<div class='navbar'>
    <?php
        require('navbar.php');
    ?>
</div>

    <div class="contact-container">
        <div class="banner">
            <img src="../logo/basket.png" alt="basket" />
            <h1>Contact Us</h1>
            <img src="../logo/basket.png" alt="basket" />
        </div>

        <div class="contact-info">
            <div class="contact-part1">
                <div class="contact-con">
                    <div class="contact-detail">
                        <h3>Address</h3>
                        <div class="contact-def">
                            <p>6th Forrest Ray, Manhattan</p>
                            <p>NYC 10001, USA</p>
                        </div>
                    </div>
    
                    <div class="contact-detail">
                        <h3>Mobile</h3>
                        <div class="contact-def">
                            <p>Mobile 1: (+01)-212-33-6789</p>
                            <p>Mobile 2: (+01)-212-66-8888</p> 
                           <p>Hotline: 1900 888 888</p>
                        </div>
                    </div>
    
                    <div class="contact-detail">
                        <h3>Email</h3>
                        <div class="contact-def">
                            <p>Contact@sample.com</p>
                            <p>Support@sample.com</p>
                        </div>
                    </div>
                    <div class="contact-detail">
                        <h3>Time</h3>
                        <div class="contact-def">
                            <p>Monday-Friday : 08:00 - 20:00</p>
                            <p>Saturday-Sunday: 13:00 - 22:00</p>
                        </div>
                    </div>
                </div>

                <div class="contact-input">
                    <h3>Drop us a line</h3>
                    <div class="contact-input-info">
                        <input type="text" placeholder="Your Name" />
                        <input type="text" placeholder="Your Email"/>
                    </div>
                    <input class='message' type="text" placeholder="Your Message...."/>
                    <input  class='btn' type="submit" name="contact" value="Send"/>
                </div>

                <div class="contact-social">
                    <a href="#"><img src='../logo/google.png' alt="facebook"/></a>
                    <a href="#"><img src='../logo/facebook.png' alt="facebook"/></a>
                    <a href="#"><img src='../logo/instagram.png' alt="facebook"/></a>
                    <a href="#"><img src='../logo/twitter.png' id="twitter" alt="facebook"/></a>
                </div>
            </div>
            <!-- Google Map -->
            <div class="contact-part2" id="googleMap">
                <iframe  width="100%" heigth="100%" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4250.485024464823!2d85.32520540700348!3d27.6913867956088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2snp!4v1678955705047!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

        <?php
            require('footer.php');
        ?>
</div>
        
</body>
</html>