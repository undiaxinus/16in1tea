<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Interactive Messages</title>
  <style>
   

    .msg {
      position: fixed;
      top: 40px;
      left: 50%;
      padding: 10px 20px;
      border-radius: 5px;
      color: white;
      font-size: 14px;
      font-weight: 800;
      box-shadow: 0 0 14px rgba(0, 0, 0, 0.05);
      opacity: 0;
      transform: translateY(-100%) translateX(-50%);
      transition: all 1s;
       z-index: 999;
    }

    .msg-success {
      background-color: #28a745;
    }

    .msg-danger {
      background-color: #dc3545;
    }

    .msg-warning {
      background-color: #ffc107;
    }

    .msg-info {
      background-color: #17a2b8;
    }

    .msg.active {
      opacity: 1;
      transform: translateX(-50%) translateY(-50%);
    }
  </style>
</head>
<body>

<!-- message -->

<div class="msg"></div>
<!-- end message -->

<div>
  <!-- Removed the buttons for automatic popup -->
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  (function () {
    // data
    var clear;
    var msgDuration = 2000; // 2 seconds
    var messages = [
      "Annette Flores: Successfully Ordered! 10 packs",
      "Arlene Navaro: Successfully Ordered! 2 packs",
      "Daisy Balasta: Successfully Ordered! 7 packs",
      "Emma Diaz: Successfully Ordered! 15 packs",
      "Evelyn Navaro: Successfully Ordered! 11 packs",
      "Gladys Villar: Successfully Ordered! 19 packs",
      "Judith Banquiles: Successfully Ordered! 9 packs",
      "Norma Lotino: Successfully Ordered! 2 packs",
      "Carlo Lopera: Successfully Ordered! 1 packs",
      "Stella Flores: Successfully Ordered! 5 packs",
      "Edison Ronda: Successfully Ordered! 9 packs",
      "John Joel Balderam: Successfully Ordered! 2 packs",
      "Ruth Balasta: Successfully Ordered! 8 packs",
      "Joseph Anonuevo: Successfully Ordered! 10 packs",
      "Lucas Le: Successfully Ordered! 10 packs",
      "Oscar Dela Cruz: Successfully Ordered! 10 packs",
      "Samuel Bercasio: Successfully Ordered! 12 packs"
    ];

    // cache DOM
    var $msg = $(".msg");

    // render message
    function render(message) {
      hide();
      $msg.addClass("msg-success active").text(message);
    }

    function timer() {
      clearTimeout(clear);
      clear = setTimeout(function () {
        hide();
      }, msgDuration);
    }

    function hide() {
      $msg.removeClass("msg-success msg-danger msg-warning msg-info active");
    }

    // Automatically trigger a different message every 5 seconds
    setInterval(function() {
      var randomIndex = Math.floor(Math.random() * messages.length);
      render(messages[randomIndex]);
    }, 1 * 1000); // 5 seconds in milliseconds

    $msg.on("transitionend", timer);
  })();
</script>
</body>
</html>
