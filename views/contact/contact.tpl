{extends file="base.tpl"}

{block name="page-title"}
    :: {$page->menuItemTitle->value}
{/block}

{block name="content"}


    <div class="contact_block">
        {if isset($errors)}
            <div class="alert alert-danger" role="alert">
                {foreach from=$errors item=e}
                    {if isset($messages.econtact[$e])} düzgün doldurulmayıb --- {$e}<br/>
                    {$messages.econtact[$e]} düzgün doldurulmayıb<br/>
                    {else}
                    {$e} <br/>
                    {/if}
                {/foreach}
            </div>
        {/if}

        {if isset($added)}
            <div class="alert alert-success" role="alert">
                {$messages.feedback.success}
            </div>
        {/if}
        <div class="contact_left row">
            <h3>ÜNVAN</h3>
            <h4><b>Ünvan:&nbsp;&nbsp;&nbsp;</b>AZ1000, Bakı, Səbail, Üzeyir Hacıbəyov 80</h4>
            <h4><b>Telefon:&nbsp;&nbsp;</b>(+99412) 4987351</h4>
            <h4><b>E-mail:&nbsp;&nbsp;</b>mail@sorttoxumagro.gov.az</h4>
            <iframe class="contact_iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24312.782334013707!2d49.824791945289604!3d40.3845251818482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307dabc3b06953%3A0x64d0daa228312c9e!2zSMO2a8O8bcmZdCBFdmk!5e0!3m2!1saz!2s!4v1461584504146"></iframe>
        </div>

        <div class="contact_right row">
            <h3>ELEKTRON MÜRACİƏT</h3>

            <form action="{$app_url}/{$currentLang}/contact/add" method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control input-lg" id="contactInputText1" placeholder="Ad, soyad">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control input-lg" id="contactInputText2" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control input-lg" id="contactInputText3" placeholder="Telefon">
                </div>
                <div class="form-group">
                    <input type="text" name="topic" class="form-control input-lg" id="contactInputText4" placeholder="Mövzu">
                </div>
                <div class="form-group">
                    <textarea name="content" class="form-control input-lg" rows="3" placeholder="Məzmun"></textarea>
                </div>
                <div class="form-group">
                    <img id="captcha_image" src="{$captcha.image}" alt="" style="padding-right: 10px">
                    <button type="button" class="btn btn-default input-lg" id="captcha_refresh"><i class="glyphicon glyphicon-refresh"></i></button>
                    <input style="width: 50%; float: right" type="text" name="phrase" class="form-control  input-lg" placeholder="Captcha">
                </div>
                <div class="modal-footer text-center">
                    <input name="f_submit" value="GÖNDƏR" type="submit" class="btn btn-lg btn-success btn-block">
                </div>
            </form>
        </div>
        <div class="clear-both"></div>
    </div>
    <script>
        function getCaptcha(){
            var request = $.ajax({
                url: '{$app_url}/{$currentLang}/contact/refreshcaptcha',
                type: "POST",
                dataType: 'json'
            });

            request.done(function(data) {
                $("#captcha_image").attr('src', data['image']);
            });

            request.fail(function(jqXHR, textStatus) {
                console.log(jqXHR);
                console.log(textStatus);
            });
        }

        $( document ).ready(function() {
            $("#captcha_refresh").click(function(){
                getCaptcha();
            });
        });

    </script>
{/block}