<div class="panel-body" >
    <div class="">
        <?php 
            if (isset($vars['msg']))
            {
                echo $vars['msg'];
            }
        ?>
    </div>
    <div id="message">
        
    </div>
</div>
<?php if (isset($_SESSION['id'])) { ?>
<div class="panel-footer">
    <div class="row">
        <form id="tchatform">
            <div class="col-xs-10">
                <textarea id="textmsg" name="textmsg" class="form-control pb-chat-textarea" placeholder="Type your message here..."></textarea>
            </div>
            <div class="col-xs-2 pb-btn-circle-div">
                <input type="submit" name="envoyer" value="Envoyez">
            </div>
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
        </form>
    </div>
</div>
<?php } ?>