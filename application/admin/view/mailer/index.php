{extend name="public/base" /}
{block name="header"}
<style type="text/css">
.layui-form-label{width:100px;}
.layui-input-block{margin-left:130px;}
.layui-block-max-width{max-width:300px;}
</style>
{/block}
{block name="main"}
<div class="layui-fluid layui-main-content">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-space15" style="padding-top: 0; margin-top:0;">
      
      <div class="layui-col-md6">
        <div class="layui-card">
        	<form action="{:url('save')}" method="post" class="ajaxForm">
          <div class="layui-card-header">设置邮件服务器信息</div>
          <div class="layui-card-body">
            <div class="layui-form">
              <div class="layui-form-item">
                <label class="layui-form-label">发件邮箱</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="send_email" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">SMTP服务器</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="domain" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">连接协议</label>
                <div class="layui-input-block">
                	<input type="radio" name="connect_type" checked="checked" value="tls" title="TLS"/>
                	<input type="radio" name="connect_type" value="ssl" title="SSL"/>
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">SMTP端口</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="port" value="25" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label class="layui-form-label">帐号</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="account" class="layui-input">
                </div>
              </div>
              
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="password" class="layui-input"/>
                </div>
              </div>
              
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" type="submit">确认保存</button>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
        </div>
        
        <div class="layui-col-md6">
        <div class="layui-card">
          <div class="layui-card-header">发送测试邮件</div>
          <div class="layui-card-body">
            <div class="layui-form">
              <div class="layui-form-item">
                <label class="layui-form-label">测试邮箱</label>
                <div class="layui-input-block layui-block-max-width">
                  <input type="text" name="send_email" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">测试内容</label>
                <div class="layui-input-block">
                  <textarea name="content" class="layui-textarea" style="height:250px;resize:none;"></textarea>
                </div>
              </div>
              
              <div class="layui-form-item">
                <div class="layui-input-block">
                  <button class="layui-btn" type="submit">发送</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        
      </div>
    </div>
  </div>
{/block}