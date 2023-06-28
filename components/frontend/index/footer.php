

    <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("header").style.top = "0";
                document.getElementById("header").style.transition = "0.5s"
            } else {
                document.getElementById("header").style.top = "-120px";
            }
            prevScrollpos = currentScrollPos;
        }
    </script>

    <script type="text/javascript" src="public/frontend/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="public/frontend/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="public/frontend/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/frontend/js/jquery.sequence-min.js"></script>
    <script type="text/javascript" src="public/frontend/js/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script defer src="public/frontend/js/jquery.flexslider.js"></script>
    <script type="text/javascript" src="public/frontend/js/script.min.js" ></script>

    <!-- chatAI -->
    <script type="text/javascript" src="public/frontend/chat/app.js"></script>
</body>
</html>