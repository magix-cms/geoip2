{extends file="layout.tpl"}
{block name='head:title'}GeoIP2{/block}
{block name='body:id'}geoip2{/block}
{block name='article:header'}
    <h1 class="h2">Geoip2</h1>
{/block}
{block name='article:content'}
    {if {employee_access type="view" class_name=$cClass} eq 1}
        <div class="panels row">
            <section class="panel col-ph-12">
                {if $debug}
                    {$debug}
                {/if}
                <header class="panel-header">
                    <h2 class="panel-heading h5">Gestion Geoip2</h2>
                </header>
                <div class="panel-body panel-body-form">
                    <div class="mc-message-container clearfix">
                        <div class="mc-message"></div>
                    </div>

                    <div class="row">
                        <form id="geoip2_config" action="{$smarty.server.SCRIPT_NAME}?controller={$smarty.get.controller}&amp;action=edit" method="post" class="validate_form edit_form col-ph-12 col-md-6">
                            <div class="row">
                                <div class="col-ph-12 col-md-6">
                                    <div class="form-group">
                                        <label for="user_gip">USER ID :</label>
                                        <input type="text" class="form-control" id="user_gip" name="apigipData[user_gip]" value="{$apigip.user_gip}" size="50" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-ph-12 col-md-6">
                                    <div class="form-group">
                                        <label for="key_gip">API Key :</label>
                                        <input type="text" class="form-control" id="key_gip" name="apigipData[key_gip]" value="{$apigip.key_gip}" size="50" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-ph-12 col-md-6">
                                    <div class="form-group">
                                        <label for="ip_gip">IP pour test :</label>
                                        <input type="text" class="form-control" id="ip_gip" name="apigipData[ip_gip]" value="{$apigip.ip_gip}" size="50" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="switch">
                                    <input type="checkbox" id="active" name="apigipData[ws_gip]" class="switch-native-control"{if $apigip.ws_gip eq 1 || !$apigip} checked{/if} />
                                    <div class="switch-bg">
                                        <div class="switch-knob"></div>
                                    </div>
                                </div>
                                <label for="active">{#active_ws#}</label>
                            </div>
                            <div id="submit">
                                <button class="btn btn-main-theme pull-right" type="submit" name="action" value="edit">{#save#|ucfirst}</button>
                                {*<button class="btn btn-main-theme pull-right" type="button" id="testApi" name="testApi" value="test">Test</button>*}
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    {else}
        {include file="section/brick/viewperms.tpl"}
    {/if}
{/block}