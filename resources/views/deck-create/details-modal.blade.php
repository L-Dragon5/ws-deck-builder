<div class="modal fade" id="deck-create-details" tabindex="-1" role="dialog" aria-labelledby="deck-create-details-label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deck-create-details-label">Deck Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="deck-create-details-form">
                    <div class="row">
                        <div class="form-group col">
                            <label for="details-deck-name">Deck Name</label>
                            <input type="text" class="form-control" id="details-deck-name" name="name" placeholder="Enter deck name" />
                        </div>
                        <div class="form-group col">
                            <label for="details-deck-password">Deck Password</label>
                            <input type="text" class="form-control" id="details-deck-password" name="password" placeholder="Enter password" aria-describedby="details-deck-password-help" />
                            <small id="details-deck-password-help" class="form-text text-muted">Don't forget this password! You'll need it to edit the deck.</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="details-deck-description">Description</label>
                        <textarea class="form-control" id="details-deck-description" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="win" id="details-deck-winning" />
                        <label class="form-check-label" for="details-deck-winning">Winning Deck</label>
                    </div>

                    <div id="details-deck-winning-info" style="display: none;">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="details-deck-win-location">Win Location</label>
                                <input type="text" class="form-control" id="details-deck-win-location" name="win-location" placeholder="Enter location" />
                            </div>
                            <div class="form-group col">
                                <label for="details-deck-win-date">Win Date</label>
                                <input type="date" class="form-control" id="details-deck-win-date" name="win-date" placeholder="Enter date (YYYY-MM-DD) format" />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="details-deck-win-participants"># of Participants</label>
                                <input type="number" min="0" value="0" class="form-control" id="details-deck-win-participants" name="win-participants" />
                            </div>

                            <div class="form-group col">
                                <label for="details-deck-win-wins">Wins</label>
                                <input type="number" min="0" value="0" class="form-control" id="details-deck-win-wins" name="win-wins" />
                            </div>

                            <div class="form-group col">
                                <label for="details-deck-win-losses">Losses</label>
                                <input type="number" min="0" value="0" class="form-control" id="details-deck-win-losses" name="win-losses" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="deck-create-details-finish" class="btn btn-primary">Create Deck</button>
            </div>
        </div>
    </div>
</div>