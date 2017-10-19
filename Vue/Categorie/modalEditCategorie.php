<div class="modal fade" id="ModalEditCategorie">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <div>
            <label for="libelle" class="control-label col-xs-2">Libellé* :</label>
                <div class="input-group col-xs-7">
                    <input type="text" id="editCategorieLibelle" name="libelle" class="form-control" />
                </div>
            </div>
            <div style="margin-top:3%;">
                <label for="Parent" class="control-label col-xs-2">Parent :</label>
                <div class="input-group col-xs-7">
                    <select name="id_pere" class="form-control" id="edit_parent_categorie">
                            <option value=""></option>
                            <?php foreach($categories as $categorie) {?>
                                <option value="<?php echo $categorie->getId(); ?>"><?php echo $categorie->getLibelle();?></option>
                            <?php }?>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="EnregistrerModifCategorie" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  var nodeModif;
  $("#edit_categorie").on("click",function(){
      nodeModif = $('#arbre_categorie').tree('getSelectedNode');
      nodeModif = $('#arbre_categorie').tree('getSelectedNode');
      if(!nodeModif) 
      {
          alert("Selectionnez une catégorie s'il vous plaît");
          return;
      }
      $("#editCategorieLibelle").val(nodeModif.name);
      $("#edit_parent_categorie").val(nodeModif.parent.id);
      $("#ModalEditCategorie").modal("show");
  });
  $("#EnregistrerModifCategorie").on("click",function(){
      alert('');
      var libelle = $("#editCategorieLibelle").val();
      var id_pere = $("#edit_parent_categorie").val();
      if($("#editCategorieLibelle").val()=="") {
          alert('Veuillez remplir le champ obligatoire');
          return;
      }
      donnees = {"id":nodeModif.id,"libelle":libelle,"idPere":id_pere};
      $.ajax({
          url: 'index.php?controleur=ControleurCategorie&action=updateCategorie',
          type: 'POST',
          dataType: 'json',
          data:donnees,

          success : function(result, status){
             // location.reload();

         },
         error : function(result, status, err){
              //location.reload();
         }
      });

  });
</script>