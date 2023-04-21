<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    />
    <link rel="stylesheet" href="css/faq.css" />
  </head>
  <body>

  <div class="faq">

    <div class="nav-bar">
      <?php
        require('navbar.php');
      ?>
    </div>

    <div class="faq-container">
      <div class="banner">
        <img src="../logo/basket.png" alt="basket" />
        <h1>FAQ</h1>
        <img src="../logo/basket.png" alt="basket" />
      </div>

      <div class="title">
        <h3>Frequently Asked Questions</h3>
        <p>Last Updated on April 1,2023</p>
      </div>

      <div class="faq-info">
        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer1')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label> WHO SHOULD I TO CONTACT IF HAVE QUESTION?</label>
          </div>

          <div class="answer" id="answer1">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer2')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label>HOW CAN I CANCEL OR CHANGE MY ORDER?</label>
          </div>
          <div class="answer" id="answer2">
            <p>
              It is a long established fact that a reader will be distracted by
              the readable content of a page when looking at its layout. The
              point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using ‘Content here,
              content here’, making it look like readable English. Many desktop
              publishing packages and web page editors now use Lorem Ipsum as
              their default model text, and a search for ‘lorem ipsum’ will
              uncover many web sites still in their infancy. Various versions
              have evolved over the years, sometimes by accident, sometimes on
              purpose (injected humour and the like).
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer3')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label> HOW CAN I RETURN A PRODUCT?</label>
          </div>
          <div class="answer" id="answer3">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer4')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label>HOW LONG WILL IT TAKE TO GET MY PACKAGE?</label>
          </div>
          <div class="answer" id="answer4">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer5')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label for="">HOW CAN I CANCEL OR CHANGE MY ORDER?</label>
          </div>
          <div class="answer" id="answer5">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer6')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label>WHAT SHIPPING METHODS ARE AVAILABLE?</label>
          </div>
          <div class="answer" id="answer6">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>

        <div class="questions">
          <div class="faq-dorpdown" onclick="myfuntion('answer7')">
            <span class="material-symbols-outlined"> add_circle </span>
            <label>DO YOU PROVIDE ANY WARRANTY?</label>
          </div>
          <div class="answer" id="answer7">
            <p>
              Lorem Ipsum is simply dummy text of the printing and typesetting
              industry. Lorem Ipsum has been the industry’s standard dummy text
              ever since the 1500s, when an unknown printer took a galley of
              type and scrambled it to make a type specimen book. It has
              survived not only five centuries, but also the leap into
              electronic typesetting, remaining essentially unchanged. It was
              popularised in the 1960s with the release of Letraset sheets
              containing Lorem Ipsum passages, and more recently with desktop
              publishing software like Aldus PageMaker including versions of
              Lorem Ipsum.
            </p>
          </div>
        </div>
      </div>

      <div class="contact-links">
        <h3>STILL HAVE QUESTIONS? CONTACT US</h3>
        <a href="contactus.php">CONTACT US</a>
      </div>
    </div>  

    <?php
      require('footer.php');
    ?>
    </div>

    <script>
        
        function myfuntion(prop){
            if(prop=='answer1'){
                document.getElementById('answer1').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer6').style.display='none';
                document.getElementById('answer7').style.display='none';
            }

            if(prop=='answer2'){
                document.getElementById('answer2').style.display='block';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer6').style.display='none';
                document.getElementById('answer7').style.display='none';
            
            }

            if(prop=='answer3'){
                document.getElementById('answer3').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer6').style.display='none';
                document.getElementById('answer7').style.display='none';
            }

            if(prop=='answer4'){
                document.getElementById('answer4').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer6').style.display='none';
                document.getElementById('answer7').style.display='none';
            }

            if(prop=='answer5'){
                document.getElementById('answer5').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer6').style.display='none';
                document.getElementById('answer7').style.display='none';
            }

            if(prop=='answer6'){
                document.getElementById('answer6').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer7').style.display='none';
            }

            if(prop=='answer7'){
                document.getElementById('answer7').style.display='block';
                document.getElementById('answer2').style.display='none';
                document.getElementById('answer1').style.display='none';
                document.getElementById('answer3').style.display='none';
                document.getElementById('answer4').style.display='none';
                document.getElementById('answer5').style.display='none';
                document.getElementById('answer6').style.display='none';
            }
            
        }

    </script>

  </body>
</html>
