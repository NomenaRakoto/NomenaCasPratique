<div class="modal fade" id="ModalEditFiche">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modifier Fiche</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group col-xs-8">
              <label for="libelle">Libellé* : </label>
              <input type="text" name="libelle" id="libelleFicheEdit" class="form-control" />
            </div>
            <div class="form-group col-xs-8">
              <label for="libelle">Description* : </label>
              <input type="text" name="libelle" id="descriptionFicheEdit" class="form-control" />
            </div>
            <div class="form-group col-xs-8">
                   <label for="selectfiche">Catégories* : </label>
                  <select class="selectpicker selectpicker1" id="selectFicheEdit" multiple>
                      <?php foreach($categories as $categorie) {?>
                            <option value="<?php echo $categorie->getId(); ?>"><?php echo $categorie->getLibelle();?></option>
                        <?php }?>
                  </select>
            </div>
            <input type="hidden" id="idFiche"/> 
      </div>
      <div class="modal-footer">
        <button type="button" id="EnregistrerEditFiche" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $(".edit_fiche").on("click",function(){
    getCategorieFiche($(this),function(result,id){
        $("#idFiche").val(id);
        var libelle = $("#fiche" + id + " td:nth-child(1)").html();
        var description = $("#fiche" + id + " td:nth-child(2)").html();
        $('#descriptionFicheEdit').val(description);
        $("#libelleFicheEdit").val(libelle);
         $("#selectFicheEdit").selectpicker('val', result);
         $("#ModalEditFiche").modal("show");
    });
  });
    $("#EnregistrerEditFiche").on("click",function(){
      var id = $("#idFiche").val();
      var categories = $("#selectFicheEdit").val();
      var libelle = $("#libelleFicheEdit").val();
      var description = $("#descriptionFicheEdit").val();
       if(libelle=="" || description=="" || categories.length==0) {
          alert('Veuillez remplir le champ obligatoire');
          return;
      }
      donnees = {"id_fiche":id,"libelle_fiche":libelle,"description":description,"categories" : categories};
      $.ajax({
          url: 'index.php?controleur=ControleurFiche&action=updateFiche',
          type: 'POST',
          dataType: 'json',
          data:donnees,

          success : function(result, status){
              
              location.reload();

         },
         error : function(result, status, err){
            
             location.reload();
         }
      });

  });
  function getCategorieFiche(ligne,callback){
      var parent = ligne.parent();
      var id = parent.attr("id");
       $.ajax({
          url: 'index.php?controleur=ControleurFiche&action=getFicheCategories',
          type: 'POST',
          dataType: 'json',
          data:{"id_fiche" : id},

          success : function(result, status){
              callback(result,id);
         },
         error : function(result, status, err){
             callback(result,id);
         }
      });

    }
</script>