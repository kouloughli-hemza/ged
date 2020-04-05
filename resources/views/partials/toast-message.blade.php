<div class="pos-absolute t-10 r-10" style="z-index: 99999"> 
  <div class="toast" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
@if(isset ($errors) && count($errors) > 0)
  <div class="toast-header" style="background-color: #f8d7da!important;">
    <h6 class="tx-inverse tx-14 mg-b-0 mg-r-auto">Notification</h6>
    <small>11 mins ago</small>
    <button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
  </div>
@endif
@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
              <div class="toast-header alert-success" style="background-color: rgba(255, 255, 255, 0.85)!important;">
                <h6 class="tx-inverse tx-14 mg-b-0 mg-r-auto">Notification</h6>
                <small>11 mins ago</small>
                <button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="toast-body">
                {{ $msg }}
              </div>
        @endforeach
    @else
      <div class="toast-header" style="background-color: rgba(255, 255, 255, 0.85)!important;">
        <h6 class="tx-inverse tx-14 mg-b-0 mg-r-auto">Notification</h6>
        <small>11 mins ago</small>
        <button type="button" class="ml-2 mb-1 close tx-normal" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body">
          {{ $data }}
      </div>
    @endif
@endif
</div>
</div>