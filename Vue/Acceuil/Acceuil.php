<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion d'annuaire</title>
	<link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="Assets/css/style.css">
	<link rel="stylesheet" href="Assets/bootstrap/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="Assets/css/jqtree.css">
</head>
<body>
	<div id="page_title">
		<div>
			<div class="divimgtitle"><img  class="imgtitle" src="Assets/images/fleche.png" width="40" height="40"/></div>
			<span id="title_text" style="margin-top:5px;">Gestion Annuaire</span>
		</div>
	</div>


	<div class="col-sm-1"></div>
		<div id="categorie_container" class="col-sm-12 form-group container">
			<div class="col-sm-4 container_categorie">
				<div class="subtitle"><h3 style="font-weight: bold;">Catégories</h3></div>
				<div>
					<button type="button" id="add_categorie" class="btn btn-primary btn-lg" ><span class="glyphicon glyphicon-plus"></span>Ajouter</button>
					<button type="button" id="edit_categorie" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-edit"></span>Modifier</button>
					<button type="button" id="delete_categorie" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash"></span>Supprimer</button>
				</div>
				<div class="tree" id="arbre_categorie">
				  
				</div>
			</div>
			<div class="col-sm-8 container_fiche">
				<div class="subtitle"><h3 style="font-weight: bold;">Fiches</h3></div>
				<div>
					<button type="button" id="add_fiche" class="btn btn-primary btn-lg" >
					<span class="glyphicon glyphicon-plus"></span>
					Ajouter
					</button>
				</div>
				<div id="table_fiche">
					 <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Libellé</th>
					        <th>Description</th>
					        <th>Catégorie</th>
					        <th>Action</th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    		foreach ($fiches as $fiche) {
					    	?>
					    			<tr id="fiche<?php echo $fiche->getId();?>">
									    <td><?php echo $fiche->getLibelle();?></td>
									    <td><?php echo $fiche->getDescription();?></td>
									    <td><?php echo $fiche->concatCategorie();?></td>
									    <td id="<?php echo $fiche->getId();?>"><a href="#" class="delete_fiche"><span class="glyphicon glyphicon-remove"></span></a><a href="#" class="edit_fiche"><span class="glyphicon glyphicon-edit"></span></a></td>
							    	</tr>
							<?php
					    		}
					    	?>
					    	
					    </tbody>
					  </table>
				  </div>
			</div>
		</div>
		<div class="col-sm-1"></div>

	</div>

	<script src="Assets/js/jquery-3.2.1.min.js"></script>
	<script src="Assets/js/jquery.ntm.js"></script>
	<script src="Assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="Assets/js/tree.jquery.js"></script>
	<script src="Assets/bootstrap/js/bootstrap-select.min.js"></script>
	<script>
		$.ajax({
			  method: "POST",
			  url: "index.php?action=getCategorieTree",
			  data: { name: "John", location: "Boston" },
			   success : function(result, status){
			   		$('#arbre_categorie').tree('destroy');
                    data = jQuery.parseJSON(result);
				    $('#arbre_categorie').tree({
					    data: data,
					    autoOpen: true,
					    dragAndDrop: true
					});
               },

               error : function(result, status, err){
               		$('#arbre_categorie').tree('destroy');
                    data = jQuery.parseJSON(result);
               
				    $('#arbre_categorie').tree({
					    data: data,
					    autoOpen: true,
					    dragAndDrop: true
					});
               }
			});
		$(".delete_fiche").on("click",function(){
			 var parent = $(this).parent();
      		 var id = parent.attr("id");
      		 if (confirm('Etes-vous sûr de vouloir supprimer? ')) {
				$.ajax({
					url: 'index.php?controleur=ControleurFiche&action=deleteFiche',
					type: 'POST',
					dataType: 'json',
					data:{"id_fiche" : id},

					success : function(result, status){
			            //location.reload();

		           },
		           error : function(result, status, err){
			           //location.reload();
		           }
				});
			}
		});
	</script>

	<?php require $_SERVER['DOCUMENT_ROOT']."/Vue/Categorie/modalAjoutCategorie.php";?>
	
	<?php require $_SERVER['DOCUMENT_ROOT']."/Vue/Categorie/modalEditCategorie.php";?>

	<?php require $_SERVER['DOCUMENT_ROOT']."/Vue/Fiche/modalAjoutFiche.php";?>

	<?php require $_SERVER['DOCUMENT_ROOT']."/Vue/Fiche/modalEditFiche.php";?>
</body>
</html>