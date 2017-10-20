<div class="modal fade" id="ModalAjoutCategorie">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ajouter Catégorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group">
            <div>
            <label for="libelle" class="control-label col-xs-2">Libellé* :</label>
                <div class="input-group col-xs-7">
                    <input type="text" id="ajoutCategorieLibelle" name="libelle" class="form-control" />
                </div>
            </div>
            <div style="margin-top:3%;">
                <label for="Parent" class="control-label col-xs-2">Parent :</label>
                <div class="input-group col-xs-7">
                    <select name="id_pere" class="form-control" id="ajout_parent_categorie">
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
        <button type="button" id="EnregistrerAjoutCategorie" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $("#add_categorie").on("click",function(){
      var nodeAjout = $('#arbre_categorie').tree('getSelectedNode');
      $("#ajout_parent_categorie").val(nodeAjout.id);
      $("#ModalAjoutCategorie").modal("show");
  });
  $('#EnregistrerAjoutCategorie').on("click",function(){
    var libelle = $('#ajoutCategorieLibelle').val();
    var parentId = $('#ajout_parent_categorie').val();
    if(libelle==""){
      alert('Veuillez remplir le champ obligatoire');
      return;
    }
        $.ajax({
          url: 'index.php?controleur=ControleurCategorie&action=addCategorie',
          type: 'POST',
          dataType: 'json',
          data:{"libelle" : libelle,"idPere" : parentId},
          success : function(result, status){
                 location.reload();

               },

         error : function(result, status, err){
           location.reload();
         }
        });                   
  });
</script>