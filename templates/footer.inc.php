


<!-- jQuery CDN -->
<script src="js/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="js/bootstrap.min.js"></script>
<!-- jQuery Custom Scroller CDN -->
<script src="js/mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

    <footer id="sticky-footer" class="py-2 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; Felix Jenniches</small>
    </div>
    </footer>

    <style media="screen">
    /* Sticky Footer Classes */

    html,
    body {
    height: 100%;
    }

    #page-content {
    flex: 1 0 auto;
    }

    #sticky-footer {
    flex-shrink: none;
    position: fixed;
    bottom: 0;

    width: 100%;
    }
    </style>

  </body>
</html>
