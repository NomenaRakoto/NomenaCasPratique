<div class="modal fade" id="ModalAjoutFiche">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group col-xs-8">
              <label for="libelle">Libellé* : </label>
              <input type="text" name="libelle" id="libelleFicheAjouter" class="form-control" />
            </div>
            <div class="form-group col-xs-8">
              <label for="libelle">Description* : </label>
              <input type="text" name="libelle" id="descriptionFicheAjouter" class="form-control" />
            </div>
            <div class="form-group col-xs-8">
                   <label for="selectfiche">Catégorie* : </label>
                  <select class="selectpicker selectpicker1" id="selectFicheAjouter" multiple>
                      <?php foreach($categories as $categorie) {?>
                            <option value="<?php echo $categorie->getId(); ?>"><?php echo $categorie->getLibelle();?></option>
                        <?php }?>
                  </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="EnregistrerAjoutFiche" class="btn btn-primary">Enregistrer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
  $("#add_fiche").on("click",function(){
      $("#ModalAjoutFiche").modal("show");
  });
  $("#EnregistrerAjoutFiche").on("click",function(){
      var categories = $("#selectFicheAjouter").val();
      var libelle = $("#libelleFicheAjouter").val();
      var description = $("#descriptionFicheAjouter").val();
       if(libelle=="" || description=="" || categories.length==0) {
          alert('Veuillez remplir le champ obligatoire');
          return;
      }
      donnees = {"libelle":libelle,"description":description,"categories" : categories};
      $.ajax({
          url: 'index.php?controleur=ControleurFiche&action=insertFiche',
          type: 'POST',
          dataType: 'json',
          data:donnees,

          success : function(result, status){
              
              //location.reload();

         },
         error : function(result, status, err){
            
             //location.reload();
         }
      });

  });
</script>