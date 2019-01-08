<link rel="stylesheet" href="../../../assets/css/geral.css">
<div class="row">
     <div class="col-lg-12">
       <br />
       <h3>Book List</h3>
       <br>
       <table class="table table-bordered table-hover">
         <thead>
             <th>Id</th>
             <th>Book's name</th>
             <th>Author</th>
             <th>Description</th>
             <th>Isbn</th>
             <th>Cover</th>
         </thead>
         <?php foreach ($books as $b) { ?>
           <tr>
               <td><?php echo $b['id'];?></td>
               <td><?php echo $b['name'];?></td>
               <td><?php echo $b['author'];?></td>
               <td><?php echo $b['description'];?></td>
               <td><?php echo $b['isbn'];?></td>
               <td><?php echo $b['cover'];?></td>
           </tr>
         <?php } ?>
       </table>

       </div>
     </div>
