<div class="row">
     <div class="col-lg-12">
       <br />
       <h3> Books List </h3>
       <h6><button><a href="http://localhost/ws/Filmes/index.php/book/newbook">Insert a new book</a></button>
       <button><a href="http://localhost/ws/Filmes/index.php/book/newRate">Rate book</a></button></h6>
       <br>
       <table class="table table-bordered table-hover">
         <thead>
             <th>Id</th>
             <th>Rating</th>
             <th>Title</th>
             <th>Year</th>
             <th>Description</th>
             <th>Gender</th>
             <th>User</th>

         </thead>
         <?php foreach ($books as $b) { ?>
           <tr>
               <td><?php echo $b['id'];?></td>
               <td><?php echo $b['rating'];?></td>
               <td><?php echo $b['title'];?></td>
               <td><?php echo $b['year'];?></td>
               <td><?php echo $b['description'];?></td>
               <td><?php echo $b['genders'];?></td>
               <td><?php echo $b['user_id'];?></td>
           </tr>
         <?php } ?>
       </table>

       </div>
     </div>
