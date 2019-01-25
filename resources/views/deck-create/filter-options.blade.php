<div class="row mb-2">
    <div class="col-sm-12 col-md-5 col-lg-3">
        <div class="filters-group">
            <label for="filters-search-input">Search</label>
            <input class="textfield filter__search js-shuffle-search form-control" type="search" id="filters-search-input" />
        </div>
    </div>

    <div class="col-sm-12 col-md-7 col-lg-9">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <label>Filter</label><br />
                <div class="btn-group filter-options">
                    <button class="btn btn-outline-primary" data-group="Character">Character</button>
                    <button class="btn btn-outline-primary" data-group="Event">Event</button>
                    <button class="btn btn-outline-primary" data-group="Climax">Climax</button>
                </div>
                <br />
                <div class="btn-group color-filter-options">
                    <button class="btn btn-outline-primary" data-group="Yellow">Yellow</button>
                    <button class="btn btn-outline-primary" data-group="Green">Green</button>
                    <button class="btn btn-outline-primary" data-group="Red">Red</button>
                    <button class="btn btn-outline-primary" data-group="Blue">Blue</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 mb-2">
        <label>Sort</label><br />
        <div class="btn-group sort-options">
            <label class="btn btn-outline-primary active">
                <input type="radio" name="sort-value" value="" checked /> ID
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="sort-value" value="name-a-z" /> Name (A-Z)
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="sort-value" value="name-z-a" /> Name (Z-A)
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="sort-value" value="level-low-high" /> Level (Low-High)
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="sort-value" value="level-high-low" /> Level (High-Low)
            </label>
        </div>
    </div>
</div>