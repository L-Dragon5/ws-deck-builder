<div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="Item Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="item-modal-title">Edit Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group" id="item-form">
            <div class="container-fluid">

              <div class="row">
                <div class="col-lg-10">
                  <label for="item-custom-title">Custom Title:</label>
                  @isset($item->custom_title)
                    <input type="text" id="item-custom-title" class="form-control" value="{{ $item->custom_title }}" />
                  @else
                    <input type="text" id="item-custom-title" class="form-control" />
                  @endisset
                </div>

                <div class="col-lg-2">
                  <label for="item-quantity">Quantity:</label>
                  @isset($item->quantity)
                    <input type="number" id="item-quantity" min="1" class="form-control" value="{{ $item->quantity }}" />
                  @else
                    <input type="number" id="item-quantity" min="1" class="form-control" />
                  @endisset
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-lg-12">
                  <span>Tags:</span>
                  <select class="form-control" id="item-tags" multiple="multiple"></select>
                </div>
              </div>

              <br>

              <div class="row">
                <div class="col-lg-12">
                  <label>Notes:</label>
                  @isset($item->notes)
                    <textarea class="form-control" id="item-notes" rows="5">{{ $item->notes }}</textarea>
                  @else
                    <textarea class="form-control" id="item-notes" rows="5"></textarea>
                  @endisset

                </div>
              </div>

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="saveButton btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


