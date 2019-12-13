    <footer class="page-footer font-small">
      <div class="footer-copyright text-center py-3">© 2019 Copyright Investor</div>
    </footer>

    <script>
      let chartperhari = document.getElementById('chartperhari').getContext('2d');

      let massPopChart = new Chart(chartperhari, {
        type:'line', //bar, horizontalBar, pie, line, dought, radar, polarArea
        data:{
          labels:[
            <?php foreach ($ambil3 as $row): ?>
              <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
                $th = date("d-M", strtotime($row['tgl_profit']));
                echo '"'.$th.'",';
                ?>
              <?php endif; ?>
            <?php endforeach; ?>
          ],
          datasets:[{
            label:'Perhari',
            backgroundColor: 'transparent',
            borderColor: 'rgb(0,0,0)',
            data:[
              <?php foreach ($ambil3 as $row): ?>
                <?php if (isset($_COOKIE['id']) && isset($_COOKIE['key'])):
                  $sql = mysqli_query($koneksi, "SELECT * FROM pengelola WHERE id_pengelola=$id_pengelola");
                  $data = mysqli_fetch_array($sql);
                  $profit = $row['total_profit']*$data['nisbah_pengelola'];
                  echo '"'.$profit.'",';
                  ?>
                <?php endif; ?>
              <?php endforeach; ?>
            ],
          }]
        }
      });
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>
</html>
