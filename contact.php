<?php 
include 'header.php';
?>
<div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1>Contactformulier</a></h1>
                    <form> id="contact-form" method="post" action="contact.php" role="form">

    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Voornaam*</label>
                    <input id="form_name" type="text" name="Voornaam" class="form-control" placeholder="Vul hier uw voornaam in *" required="required" data-error="Vul uw voornaam in.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Achternaam*</label>
                    <input id="form_lastname" type="text" name="Achernaam" class="form-control" placeholder="Vul hier uw achternaam in *" required="required" data-error="Vul uw achternaam in.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email*</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Vul hier uw emailadres in. *" required="required" data-error="Vul uw emailadres in.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_phone">Telefoonnummer</label>
                    <input id="form_phone" type="tel" name="Telefoonnummer" class="form-control" placeholder="Vul hier uw telefoonnummer in. ">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Bericht*</label>
                    <textarea id="form_message" name="Bericht" class="form-control" placeholder="Vul hier uw bericht in *" rows="4" required="required" data-error="Vul uw bericht in."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-success btn-send" value="Send message">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> Deze velden zijn verplicht.</p>
            </div>
        </div>
    </div>
</form> 

                </div>

            </div>

        </div>

<?php 
include 'footer.php';
?>