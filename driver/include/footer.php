    
    <div class="fixed-action-btn">
    <a class="btn-floating btn-large blue accent-2">
        <i class="large material-icons">menu</i>
    </a>
    <ul>
        <li><a class="btn-floating red"><i class="material-icons">info_outline</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">message</i></a></li>
    </ul>
    </div>
          
    </body>
  </html>

<!-- Compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>   
<script>

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      direction: 'left',
      hoverEnabled: false
    });
  });
  
       
</script>