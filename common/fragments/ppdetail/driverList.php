<div class="tab_info download">
      <article>
         <!-- <h4>Specifications</h4>
         <table>
               <tr>
                  <td>Model</td>
                  <td>RP-PB22</td>
               </tr>
               <tr>
                  <td>Capacity</td>
                  <td>13000mAh</td>
               </tr>
               <tr>
                  <td>Output</td>
                  <td>5V / 2.4A and 5V / 2.1A</td>
               </tr>
               <tr>
                  <td>Input</td>
                  <td>DC 5V/1.5A</td>
               </tr>
               <tr>
                  <td>Input</td>
                  <td>DC 5V/1.5A</td>
               </tr>
               <tr>
                  <td>Weight</td>
                  <td>10.8oz</td>
               </tr>
         </table> -->
         <h4>Manuals, Drivers, App, Software</h4>
         <?php 
         foreach($drivers as $cateName => $files):
         ?>
         <p><?= $cateName?></p>
         <?php
            foreach($files as $file):
         ?>
             <p class="pdf"><a target="_blank" href="<?= $file['fileUrl'];?>"><i></i><?= $file['description'];?></a></p>
         <?php
            endforeach;
         endforeach; 
         ?>
     </article>
 </div>