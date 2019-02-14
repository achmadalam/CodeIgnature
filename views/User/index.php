<div class="modal fade" id="LoginModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Login Form</h3>
        </div>
        <!-- body -->
        <div class="modal-body">
          <form role="form" action="user/login" method="post">
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Email" name="username"/><br/>
              <input type="password" class="form-control" placeholder="Password" name="password"/>
            </div>
        </div>
        <!-- footer -->
        <div class="modal-footer">
          <button class="btn btn-primary btn-block" type="submit">Log In</button>
        </div>
        </form>
      </div>
    </div>
  </div>