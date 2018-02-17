 <script type="text/javascript">
   var t=0;
 </script>



 
 <table class="table table-bordered" id="ltable">
  
  <thead>
            <tr style="background: #EEE; font-weight: bold;">
              <td width="5%">N-º</td>
              <td width="10%">Dni</td>
              <td width="35%">Nombres</td>
              <td width="35%">Apellidos</td>
              <td width="15%" >Descuento  <input type="text" name="" id="general" onkeyup="pon_general(this.value)" style="width: 40%; float: right;" class="form-control" value=""> </td>
              

            </tr>
</thead>
            <tbody>
            
                  <!--div style="width: 100%; min-height: 50px;  max-height: 400px; overflow: auto;"-!-->
                      
                       <!--table class="table table-bordered" style="border-left: 0px; border-top: 0px;"!-->          
                          <?php
                                      @include_once('../../modelo/MPgsql.php');
                                      $db=new CModeloDatos;

                                        if($_GET['cod'] == 'T'){
                                          $sql="SELECT id_persona,cedula,nombre1,apellido1 FROM cappiutep.t_persona order by apellido1 asc";
                                        }else{
                                          $sql="SELECT id_persona,cedula,nombre1,apellido1 FROM cappiutep.t_persona  WHERE id_tipo_persona=".$_GET['cod']." order by apellido1 asc";
                                        }

                                      

                                      $as=$db->ejecutar($sql);

                                      while ($row=$db->getArreglo($as)) {
                                        # code...
                                        $o++;
                                            echo '<script> t++; </script>';
                                        $dife= $row['monto'] - $row['monto'];
                                        echo '
                                          <tr>
                                            <td width="4.5%" style="border-left:0px; ">'.$o.'</td>
                                            <td width="10%">'.$row['cedula'].'<input type="hidden" name="cedula['.$o.']" value="'.$row['id_persona'].'" ></td>
                                            <td width="35.5%">'.$row['nombre1'].' '.$row['nombre2'].'</td>
                                            <td width="35.5%">'.$row['apellido1'].' '.$row['apellido2'].'</td>
                                            <td width="15%"><input type="text" name="compra['.$o.']" class="form-control" id="dsc_'.$o.'" value="0" onkeyup="sumame(this.value,'.$o.')" style="width:80%;"></td>
                                            
                                          </tr>
                                        ';
                                      } 
                                ?>
                                   
                        <!--/table>

                  </div!-->
             

            
          </tbody>

            <tr>
              <td colspan="4" align="right"> <b>TOTAL</b></td>
              <td colspan="" align="right" style="width: 15%;">
                <input type="" class="form-control" name="" id="muestra_f" readonly="" value="0"  >
              </td>
             </tr> 
            <tr>
              <td colspan="5" align="center">
                <br>

  </table>
  <center> <tr>
              <td colspan="5" >
                  <button class="btn btn-primary" type="submit" name="evento" value="guardar" onclick="return verificame()"> <span class="glyphicon glyphicon-floppy-disk"> </span> Guardar <span class="glyphicon glyphicon-floppy-disk"></span></button>
              </td>
            </tr> 
  </center>

  <script type="text/javascript">
      function sumame(d,p){

        div=document.getElementById('muestra_f');
        
        var y=0;

        for(h=1; h<=t; h++){
          dsc=document.getElementById('dsc_'+h);
          if(dsc.value==''){ nu=0; dsc.value=0;  }else{ nu=dsc.value; }

          y= parseFloat(y) + parseFloat(nu);
        }
      
        div.value=y;
        
      }

      function pon_general(p) {
        // body...
         var yi=0;
         div=document.getElementById('muestra_f');
       
         for(y=1; y<=t; y++){

          dsc=document.getElementById('dsc_'+y);

          dsc.value=p;
          yi= parseFloat(yi) + parseFloat(p);

         }
         div.value=yi;

      }

      $(document).ready(function() {
        $('#ltable').DataTable({

          "language": {
            "search":         "Buscar:",
            "zeroRecords":    "No se encontraron registros."
        },
        "paging":   false,
        "ordering": false,
        "info":     false
        
    });
      } );


      function verificame() {
        // body...

          if(!confirm('Seguro de realizar esta Operacion')){
            return false;
          }else{
            
             return true;
          }

        
      }


  </script>