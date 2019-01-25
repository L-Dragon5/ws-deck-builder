<div class="modal fade" id="item-modal" tabindex="-1" role="dialog" aria-labelledby="Item Modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="item-modal-title">View Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4">
              <div id="image-block">
                <img class="img-fluid" src="{{ $item->image_url }}" />
              </div>
            </div>
            <div class="col-lg-8">

              <div class="row">
                <div class="col-lg-12">
                  <h4>Item Information</h4>
                  <div id="title-block">
                    <p>
                      @empty($item->custom_title)
                        Title: {{ $item->original_title }}
                      @else
                        Title: {{ $item->custom_title }}
                      @endempty
                    </p>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div id="info-block">
                    <p>
                      Seller: {{ $item->seller_name }}
                      <br>
                      Price: {{ $item->price }}
                    </p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div id="misc-block">
                    <p>
                      Quantity: @empty($item->quantity) 0 @else {{ $item->quantity }} @endempty
                      <br>
                      URL: <a href="{{ $item->listing_url }}" target="_blank" class="btn btn-primary">Go to Listing</a>
                      <br><br>
                      Tags:
                      @forelse ($item->tags as $tag)
                        <span class="tag-list">{{ $tag->name }}</span>
                      @empty
                        N/A
                      @endforelse
                    </p>
                  </div>
                </div>
              </div>

              <!-- Notes -->
              <div class="row">
                <div class="col-lg-12">
                  <h4>Notes</h4>
                  <div id="notes-block">
                    <p class="lead">
                      @empty($item->notes)
                        No notes
                      @else
                        {{ $item->notes }}
                      @endempty
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
