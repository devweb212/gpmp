<?php
include('session.php'); 
require_once 'functions.php';
if($_SESSION['role']!='Admin'){
header('location: index.php');
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Staport  - gestion electronique des documents</title>
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/bstreeview.css" />
  <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
  <link href="css/smartselect.min.css" rel="stylesheet" />
  <link href='css/select2.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" />
    
  <link rel="shortcut icon" href="images/favicon.png" />


</head>

<body>
    <script src="js/jquery-1.9.1.min.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.smartselect.min.js"></script>
  <div class=" container-scroller">
    <!-- partial:partials/_navbar.html -->
    
  
    
  <nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="bg-white text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="index.html">StaportGAE</a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo_star_mini.jpg" alt=""></a>
      </div>
   <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
          <span class="navbar-toggler-icon"></span>
        </button>
      <a href="index.php" type="button" class="btn  btn-secondary mr-2">Recherche générale
                  </a>
       
        <?php if($_SESSION['role']=='Admin'){?>
          <a href="add_doc.php" type="button" class="btn btn-success mr-2">Ajouter des documents</a>
          <a href="m_c.php" type="button" class="btn btn-secondary mr-2">Gérer les dossiers</a>
        
            
              <a href="role.php" type="button" class="btn btn-secondary mr-2">Ajouter un role </a>

                <a href="add_type.php" type="button" class="btn btn-secondary mr-2">Ajouter un type document </a>

              <?php } ?>
                <?php if($_SESSION['role']=='SuperAdmin'){?>
                <a href="user.php" type="button" class="btn btn-secondary mr-2">Ajouter utilisateur</a>
<?php } ?>
           <a href="/ged/logout.php" type="button" class="btn btn-secondary mr-2">Deconnexion</a>

  <form class="form-inline mt-2 mt-md-0 d-none d-lg-block ml-auto p-2">
          <input class="form-control mr-sm-2 search" type="text" placeholder="Recherche">
        </form>
      
        <button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
  
  

    <!-- partial -->
    <div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-right">
        <!-- partial:partials/_sidebar.html -->
          <nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
          <div class="user-info">
            <img src="images/face.jpg" alt="">
            <p class="name"><?php echo $nom_user; ?></p>
            <p class="designation"><?php echo $_SESSION['role']; ?></p>
            <span class="online"></span>
         </div>
       <?php require_once 'nav.php';?>
   
    </nav>

        <!-- partial -->
    
    <div class="content-wrapper">
   <h3 class="page-heading mb-4">Ajouter des documents</h3>
   <div class="row">
      <div class="col-md-8 mb-4">
         <div class="card">
            <div class="card-body">
               <h5 class="card-title mb-4">Ajouter des documents</h5>
              
                <form enctype="multipart/form-data" action="" method="post">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Veuillez saisir le nom du document
</label>
                     <input type="text" class="form-control p-input" 
                     id="exampleInputEmail1" name="nom_document" placeholder="Le nom du document">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Veuillez saisir une description du document
</label>
                     <input type="text" class="form-control p-input"  placeholder="Description du document"  name="des_document" >
                  </div>
                  
                 
                        <input type="hidden" class="input-sm form-control" name="date_archiv" placeholder="Date d'archivage"  style="text-align: left;" value="<?php echo date("d-m-Y"); ?>">
                       



  <?php 
            


           
                
      $categoryList = fetchCategoryTree();
      ?>
      <div class="form-group" style="display:none">
                           <label for="exampleInputPassword1">Choisisez un dossier parent</label>
      <div style="text-align: left;font-weight: 700;" >
            <select  class="selectpicker  form-control smartselect dropdown" data-live-search="true" name="dosier_pp"  id='selUserr'>
       <option value="0" selected="selected">Choisisez un dossier parent </option>
        <?php foreach($categoryList as $cl) { ?>

        <option value="<?php echo $cl["id"] ?>"><?php echo $cl["name"]; ?></option>

        <?php } ?>
        </select>

         <input type="hidden" id="selUser" name="dosier_p" value="0" />

      </div>
 </div>
                  <div class="form-group">
    <label for="exampleFormControlFile1">Fichier à joindre</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file_doc" style="
    background: #2b93e7;
    color: #fff !important;
">
  </div>
 <input type="hidden" name="MAX_FILE_SIZE" value="300000000000" />


<div class="form-group">
                     <label for="exampleInputPassword1">Choisissez le type de fichier</label>
                    <div style="text-align: left;font-weight: 700;" >
            <?php
       $sqll = "SELECT * FROM typed WHERE deletee IS NULL ORDER BY id desc";
         $result_user = mysqli_query($db,$sqll);
   

?>
      <select name="user_type"  class="selectpicker  form-control smartselect dropdown" 
       onchange="go()" id="user_type">
          <option value="" selected="selected">Choisissez le type de fichier</option>
        <?php  while($row_user = mysqli_fetch_array($result_user,MYSQLI_ASSOC))
        { ?>
        <option value="<?php echo $row_user['id']; ?>"><?php echo $row_user['type']; ?></option>

       <?php } ?>
      </select>

       

      </div>
                  </div>
              
            

<div class="form-group"  id="demo">
                     <label for="exampleInputPassword1">Liste des mots clés</label>
   <div class="input-daterange input-group">

<input type="text" class="input-sm form-control" name="mot_cle" placeholder="Mots clés"  style="text-align: left;">
                      </div>
                  </div>

                  <div class="form-group">
                     <button type="submit" class="btn btn-primary">ajouter document </button>
                  </div>
                   </form>

                <?php
    
  
      
      if($_SERVER["REQUEST_METHOD"] == "POST") {
          if(isset($_POST["nom_document"]) 
        ){
        $nom_document = $_POST["nom_document"]; 
        $des_document = $_POST["des_document"]; 
        $mot_cle = $_POST["mot_cle"]; 
       
        $id_parent = $_POST["dosier_p"];
        $user_type = $_POST["user_type"];
        

        $file_doc = $_FILES['file_doc']['name'];  

       @$elementsChemin = pathinfo($file_doc);
        @$extensionFichier = $elementsChemin['extension'];

        $date_archiv = strtotime($_POST["date_archiv"]);  
        $date_creatione = date("d-m-Y H:i:s");    
        
    
   
       
if($id_parent!=0){
$sql3 = " SELECT t1.cid as cat_id, CONCAT_WS('/', t8.name, t7.name, t6.name, t5.name, t4.name, t3.name, t2.name, t1.name) as chemin FROM category 
AS t1 LEFT JOIN category 
AS t2 ON t2.cid = t1.parent LEFT JOIN category
AS t3 ON t3.cid = t2.parent LEFT JOIN category
AS t4 ON t4.cid = t3.parent LEFT JOIN category
AS t5 ON t5.cid = t4.parent  LEFT JOIN category
AS t6 ON t6.cid = t5.parent  LEFT JOIN category
AS t7 ON t7.cid = t6.parent LEFT JOIN category
AS t8 ON t8.cid = t7.parent
WHERE t1.cid =".$id_parent;

     $result_ch = mysqli_query($db,$sql3);
    while($row = mysqli_fetch_array($result_ch,MYSQLI_ASSOC))
        {

         $nome_d = "upload/".$row['chemin']."/"; // Le nom du répertoire à créer
    
   
 
 }
}else{
    echo "<div class='alert alert-danger' role='alert' style='
    margin-top: 20px;'>Merci de Choisisez le dossier parent!</div>";
  
 }
 
if(isset($nome_d) and !empty($nome_d ) and isset($user_type) and !empty($user_type) and isset($file_doc) and !empty($file_doc) and isset($mot_cle) and !empty($mot_cle)){

$extensionsAutorisees = array("jpeg", "jpg", "gif","doc","docx","docm","dotx","dotm","pdf","txt","xlsx");
if (!(in_array($extensionFichier, $extensionsAutorisees))) {
    echo "<div class='alert alert-danger' role='alert' style='
    margin-top: 20px;'>Le fichier n'a pas l'extension attendue</div>";
} else {    
    // Copie dans le repertoire du script avec un nom
    // incluant l'heure a la seconde pres 
    $repertoireDestination = $nome_d;
    $nomDestination = "fichier_du_".date("YmdHis").".".$extensionFichier;

    if (move_uploaded_file($_FILES["file_doc"]["tmp_name"], 
                                     $repertoireDestination.$nomDestination)) {
     echo '<div class="alert alert-success" role="alert" style="
    margin-top: 20px;
">
  Le fichier temporaire '.$nom_document.'   a été déplacé vers le dossier '.$nome_d.' avec success</div>';

    $sql_insert = "INSERT INTO doc (nom, description, type, archivage, id_dossier,upload,keyword,darte_creation,user,user_type) VALUES  ('$nom_document','$des_document','$extensionFichier','$date_archiv','$id_parent' ,'$nomDestination','$mot_cle' ,'$date_creatione',$id_user,$user_type)";



      $result_insert = mysqli_query($db,$sql_insert);
    } else {
         echo"<div class='alert alert-danger' role='alert' style='
    margin-top: 20px;'>Le fichier n'a pas été uploadé (trop gros ?) ou Le déplacement du fichier temporaire a échoué 
    </br>
    vérifiez l'existence du répertoire ".$repertoireDestination."
    </div>";
    }
}

    }else{
      echo "<div class='alert alert-danger' role='alert' style='
    margin-top: 20px;'>Merci de remplir tous les champs nécessaire</div>"; 
    }
          }
          }

      ?>
            </div>
         </div>
      </div>
     <div class="col-md-4 mb-4">
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive table-sales">
                        <div class="treeview-animated w-20 border mx-4 my-4" id="tree">
                           <h6 class="pt-3 pl-3"> Dossiers</h6>
                           <hr>



                           <ul class="treeview-animated-list mb-3">
                              <li class="treeview-animated-items">
                                 <a class="closed open">
                                 <i class="fa fa-angle-right down"></i>
                                 <span><i class="fa fa-folder-open ic-w mx-1"></i>Inbox</span>
                                 </a>

                                         <?php
                                                   $res = fetchCategoryTreeListf();
                                                    foreach ($res as $r) {
                                                      echo  $r;
                                                     }

                                                                         ?>
                                 
                                   
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>

   <div class="card-deck">
      <div class="card col-lg-12 px-0 mb-4">
         <div class="card-body">

          <h5 class="card-title">Listes des documents</h5>
         <div class="table-responsive">
     
  <table class="table center-aligned-table">
   <thead>
      <tr class="text-primary">
         <th>Nom de Document</th>
       
         <th>Chemin</th>
         <th>Date d'archivage</th>
         
          <th>Ajouter par</th>
         <th>Voir le document</th>
         
         <th></th>
              <th></th>
      </tr>
   </thead>
   <tbody>
   

<?php


 $sql_d = "SELECT * FROM doc where deletee is null ORDER BY id DESC";
   




     $result_d = mysqli_query($db,$sql_d);
       while($row_d = mysqli_fetch_array($result_d,MYSQLI_ASSOC))
        {

if($row_d['id_dossier']!=0){

$sql3 = " SELECT t1.cid as cat_id, CONCAT_WS('/', t8.name, t7.name, t6.name, t5.name, t4.name, t3.name, t2.name, t1.name) as chemin FROM category 
AS t1 LEFT JOIN category 
AS t2 ON t2.cid = t1.parent LEFT JOIN category
AS t3 ON t3.cid = t2.parent LEFT JOIN category
AS t4 ON t4.cid = t3.parent LEFT JOIN category
AS t5 ON t5.cid = t4.parent  LEFT JOIN category
AS t6 ON t6.cid = t5.parent  LEFT JOIN category
AS t7 ON t7.cid = t6.parent LEFT JOIN category
AS t8 ON t8.cid = t7.parent
WHERE t1.cid =".$row_d['id_dossier'];

     $result_ch = mysqli_query($db,$sql3);
    while($row = mysqli_fetch_array($result_ch,MYSQLI_ASSOC))
        {

   
   $nome_d = ">>".$row['chemin']; // Le nom du répertoire à créer
    $nome_dch = "upload/".$row['chemin']; // Le nom du répertoire à créer
 }
}else{
   $nome_d = "-->>"; // Le nom du répertoire à créer
   $nome_dch = "upload/"; // Le nom du répertoire à créer
 }
?>
       <tr class="">
                      <td><?php echo $row_d['nom']; ?></td>
              
                     <td><?php echo $nome_d ; ?></td>
                      
                       <td><?php echo $row_d['darte_creation'] ; ?></td>
         <td><label><?php echo $nom_user ; ?></label></td>
          <td style="
    text-align: center;
">
          <label class="btn btn-success btn-sm"><a href="<?php echo $nome_dch.'/'.$row_d['upload'] ; ?>" target="_blank" style=" font-size: 15px;font-weight: bold;color: #fff;padding: 3px;">  Télécharger  </a></label>
          </td>

         <td><a href="update_doc.php?update=<?php echo $row_d['id']; ?>" class="btn btn-success btn-sm" style="font-size: 15px;">Modifier</a></td>

           <td><a  href="#" data-href="delete_doc.php?delete=<?php echo $row_d['id']; ?>" data-toggle="modal" data-target="#confirm-delete" class="trigger-btn btn btn-danger mr-2" >Supprimer</a></td>

        


                  
        </tr>            
                     
<?php
}
?>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmation de la suppression</h4>
                </div>
            
                <div class="modal-body">
                 
                   <div class="alert alert-danger" role="alert">
            Êtes-vous sûr de vouloir supprimer ce Fichier ?
                     </div>
                 
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Supprimer</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
           
        });
    </script>
   </tbody>
</table>

</div>

    </div>
      </div>
   </div>
</div>

  
    <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="float-right">
                <a href="#">Staport  - gestion electronique des documents</a> &copy; 2017
            </span>
          </div>
        </footer>

        <!-- partial -->
      </div>
    </div>

  </div>


 

 <script src='js/jquery-3.2.1.min.js' type='text/javascript'></script>
  <script src='js/select2.min.js' type='text/javascript'></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
   <script>
   (function ($) {
  let $allPanels = $('.nested').hide();
  let $elements = $('.treeview-animated-element');

  $('.closed').click(function () {
   
    $this = $(this);
    $target = $this.siblings('.nested');
    $pointer = $this.children('.fa-angle-right');

    $this.toggleClass('open')
    $pointer.toggleClass('down');

    !$target.hasClass('active') ? $target.addClass('active').slideDown() : 
     $target.removeClass('active').slideUp();

    return false;
  });

  $elements.click(function () {
   
    $this = $(this);

   
    $this.hasClass('opened') ? ($this.removeClass('opened')): ($elements.removeClass('opened'), $this.addClass('opened'));
  })
})(jQuery);



$(function(){
    var treeView = $("#treeview").dxTreeView({ 
        items: products,
        width: 500,
        searchEnabled: true
    }).dxTreeView("instance");

    $("#searchMode").dxSelectBox({
        items: ["contains", "startswith"],
        value: "contains",
        onValueChanged: function(data) {
            treeView.option("searchMode", data.value);
        }
    });
});

$('#datepicker').datepicker({
    language: "fr",
    autoclose: true,
    todayHighlight: true,
    beforeShowDay: function(date){
          if (date.getMonth() == (new Date()).getMonth())
            switch (date.getDate()){
              case 4:
                return {
                  tooltip: 'Example tooltip',
                  classes: 'active'
                };
              case 8:
                return false;
              case 12:
                return "green";
          }
        },
    toggleActive: true
});


      $(document).ready(function(){
            
            // Initialize select2
            $("#selUser").select2();

            // Read selected option
            $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
           
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });


$(".dos_id").on( "click", function() {

  var fname = $(this).find("[name='fname']").val();
   var fnamee = $(this).find("[name='fnamee']").val();
   alert(`Vous avez choisissez le dossier : ${fnamee} comme un dossier parent`);


    $("#selUser").val(fname);


});
  </script>

   <script type="text/javascript">
 
    
 function getXhr(){
                         var xhr = null; 
                 if(window.XMLHttpRequest) // Firefox et autres
                 xhr = new XMLHttpRequest(); 
                 else if(window.ActiveXObject){ // Internet Explorer 
                 try {
                      xhr = new ActiveXObject("Msxml2.XMLHTTP");
                     } catch (e) {
                      xhr = new ActiveXObject("Microsoft.XMLHTTP");
                     }
                   }
        else { // XMLHttpRequest non supporté par le navigateur 
                        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
                      xhr = false; 
                   } 
                                return xhr;
                     }
      function go(){
          var xhr = getXhr();
        xhr.onreadystatechange = function(){
          if(xhr.readyState == 4 && xhr.status == 200){
            leselect = xhr.responseText;
            document.getElementById('demo').innerHTML = leselect;
            
          }
        }

        // Ici on va voir comment faire du post
        xhr.open("POST","mot_cle_aj.php");
        // ne pas oublier ça pour le post
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        // ne pas oublier de poster les arguments
        // ici, le type c'est largumet qui veut envoyer vers page ajax_vedios
        sel = document.getElementById('user_type');
        user_type = sel.options[sel.selectedIndex].value;
        xhr.send("user_type="+user_type);
      }
  </script>



</body>

</html>
