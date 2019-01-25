'use strict';

var Shuffle = window.Shuffle;

var Demo = function (element) {
    this.types = Array.from(document.querySelectorAll('.filter-options button'));
    this.colors = Array.from(document.querySelectorAll('.color-filter-options button'));

    this.shuffle = new Shuffle(element, {
        itemSelector: '.deck-create__card__shuffle',
        sizer: '.deck-create__card__shuffle'
    });

    this.filters = {
        colors: [],
        types: [],
    };

    this._bindEventListeners();

    this.addSorting();
    this.addSearchFilter();
};

/**
 * Bind event listeners for when the filters change
 */
Demo.prototype._bindEventListeners = function() {
    this._onTypeChange = this._handleTypeChange.bind(this);
    this._onColorChange = this._handleColorChange.bind(this);

    this.types.forEach(function(button) {
        button.addEventListener('click', this._onTypeChange);
    }, this);

    this.colors.forEach(function(button) {
        button.addEventListener('click', this._onColorChange);
    }, this);
}

/**
 * Get the values of each active button for
 */
Demo.prototype._getCurrentTypeFilters = function() {
    return this.types.filter(function(button) {
        return button.classList.contains('active');
    }).map(function(button) {
        return button.getAttribute('data-group');
    });
};

Demo.prototype._getCurrentColorFilters = function() {
    return this.colors.filter(function(button) {
        return button.classList.contains('active');
    }).map(function(button) {
        return button.getAttribute('data-group');
    });
};

/**
 * A filter was clicked. Update filters and display
 */
Demo.prototype._handleTypeChange = function(evt) {
    var button = evt.currentTarget;

    if(button.classList.contains('active')) {
        button.classList.remove('active');
    } else {
        this.types.forEach(function(btn) {
            btn.classList.remove('active');
        });

        button.classList.add('active');
    }

    this.filters.types = this._getCurrentTypeFilters();
    this.filter();
};

Demo.prototype._handleColorChange = function(evt) {
    var button = evt.currentTarget;

    button.classList.toggle('active');

    this.filters.colors = this._getCurrentColorFilters();
    this.filter();
};

/**
 * Filter shuffle based on the current state of filters
 */
Demo.prototype.filter = function() {
    if(this.hasActiveFilters()) {
        this.shuffle.filter(this.itemPassesFilters.bind(this));
    } else {
        this.shuffle.filter(Shuffle.ALL_ITEMS);
    }
}

/**
 * Check if any of the arrays in the filters property are populated
 */
Demo.prototype.hasActiveFilters = function() {
    return Object.keys(this.filters).some(function(key) {
        return this.filters[key].length >0;
    }, this);
};

/**
 * Determine whether an element passes the current filters
 */
Demo.prototype.itemPassesFilters = function(element) {
    var types = this.filters.types;
    var colors = this.filters.colors;
    
    var type = element.getAttribute('data-type');
    var color = element.getAttribute('data-color');

    if(types.length > 0 && !types.includes(type)) {
        return false;
    }

    if(colors.length > 0 && !colors.includes(color)) {
        return false;
    }

    return true;
};

/**
 * Sorting Function
 */
Demo.prototype.addSorting = function () {
    var buttonGroup = document.querySelector('.sort-options');

    if (!buttonGroup) {
        return;
    }

    buttonGroup.addEventListener('change', this._handleSortChange.bind(this));
};

Demo.prototype._handleSortChange = function (evt) {
    // Add and remove `active` class from buttons.
    var buttons = Array.from(evt.currentTarget.children);
        buttons.forEach(function (button) {
        if (button.querySelector('input').value === evt.target.value) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
    });

    // Create the sort options to give to Shuffle.
    var value = evt.target.value;
    var options = {};

    function sortByName(element) { return element.getAttribute('data-name').toLowerCase(); }
    function sortByLevel(element) { return element.getAttribute('data-level'); }

    if(value === 'name-a-z') {
        options = {
            by: sortByName,
        };
    } else if(value === 'name-z-a') {
        options = {
            by: sortByName,
            reverse: true,
        };
    } else if(value === 'level') {
        options = {
            by: sortByLevel,
        };
    } else if(value === 'level-high-low') {
        options = {
            by: sortByLevel,
            reverse: true,
        };
    }else {
        options = {};
    }

    this.shuffle.sort(options);
};

// Advanced filtering
Demo.prototype.addSearchFilter = function () {
var searchInput = document.querySelector('.js-shuffle-search');

if (!searchInput) {
    return;
}

searchInput.addEventListener('keyup', this._handleSearchKeyup.bind(this));
};

/**
 * Filter the shuffle instance by items with a title that matches the search input.
 * @param {Event} evt Event object.
 */
Demo.prototype._handleSearchKeyup = function (evt) {
var searchText = evt.target.value.toLowerCase();

this.shuffle.filter(function (element, shuffle) {

    // If there is a current filter applied, ignore elements that don't match it.
    if (shuffle.group !== Shuffle.ALL_ITEMS) {
    // Get the item's groups.
    var groups = JSON.parse(element.getAttribute('data-groups'));
    var isElementInCurrentGroup = groups.indexOf(shuffle.group) !== -1;

    // Only search elements in the current group
    if (!isElementInCurrentGroup) {
        return false;
    }
    }

    var titleElement = element.querySelector('.deck-create__card__title');
    var titleText = titleElement.textContent.toLowerCase().trim();

    return titleText.indexOf(searchText) !== -1;
});
};

/**
 * Document Ready Function
 */
var delayTimer;
$(document).ready(function() {
    // Check if we're on deck-creation page
    if ($('#card-grid').length > 0) {
        window.demo = new Demo(document.getElementById('card-grid'));

        /* Find way to prevent only back button, refresh, and click link
        $(window).on('beforeunload', function() {
            return 'Are you sure you want to leave?';
        });
        */

        // Initialize deck variable
        var deck = {
            series_id: $('.deck-create__building').data('series-id'),
            name: null,
            description: null,
            win: {
                check: false,
                location: null,
                date: null,
                participants: 0,
                result: null,
                ranking: null
            },
            cards: {
                characters: [],
                events: [],
                climaxes: [],
                total: 0
            },
            password: null
        };
        
        // Add click listeners to add/remove cards
        $('.deck-create__card-plus').on('click', function() {
            updateDeck($(this), deck, 'plus')
        });
        $('.deck-create__card-minus').on('click', function() {
            updateDeck($(this), deck, 'minus')
        });

        // Add click listener to completeing deck button
        $('#complete-deck-btn').on('click', function() {
            if(deck.cards.total != 50) {
                setWarningAlert("Deck must contain 50 cards.");
                return;
            }

            $('#deck-create-details').modal();
        });


        // Modal settings
        if($('#deck-create-details').length > 0) {
            $('#details-deck-winning').on('click', function() {
                $('#details-deck-winning-info').slideToggle();
            });

            $('#deck-create-details-finish').on('click', function() {
                var form = document.getElementById("deck-create-details-form").elements;
                var deckName = form.namedItem("name").value;
                var deckPass = form.namedItem("password").value;
                var description = form.namedItem("description").value;
                var winCheck = form.namedItem("win").checked;
                var winLocation = form.namedItem("win-location").value;
                var winDate = form.namedItem("win-date").value;
                var winParticipants = form.namedItem("win-participants").value
                var winWins = form.namedItem("win-wins").value;
                var winLosses = form.namedItem("win-losses").value;

                if(deckName === "") {
                    setWarningAlert("Deck name must be filled.");
                    return;
                } else if(deckPass === "") {
                    setWarningAlert("Password must be filled.");
                    return;
                }

                deck.name = deckName;
                deck.password = deckPass;
                deck.description = description;

                if(winCheck) {
                    if(winLocation === "") {
                        setWarningAlert("Winning location must be filled.");
                        return;
                    } else if(winDate === "") {
                        setWarningAlert("Winning date must be set.");
                        return;
                    } else if(!isValidDate(winDate)) {
                        setWarningAlert("Invalid date selected.");
                        return;
                    } else if(winParticipants <= 0) {
                        setWarningAlert("Participant must be greater than 0.");
                        return;
                    } else if(winWins <= 0) {
                        setWarningAlert("Wins must be greater than 0. This is a winning deck, right?");
                        return;
                    } else if(winLosses < 0) {
                        setWarningAlert("Losses must be non-negative.");
                        return;
                    }

                    deck.win.check = true;
                    deck.win.location = winLocation;
                    deck.win.date = winDate;
                    deck.win.participants = winParticipants;
                    deck.win.result = winWins + '-' + winLosses;
                }

                $.ajax({
                    url: '/decks',
                    type: 'POST',
                    data: {
                        'deck': deck
                    },
                    beforeSend: function(jqXHR, settings) {
                        $('#deck-create-details-finish').attr('disabled', true);
                        setPrimaryAlert("Building deck...");
                    },
                    success: function(data, textStatus, xhr) {
                        setPrimaryAlert("Successfully created deck. Redirecting...");
                        setTimeout(function() {
                            if(typeof(Storage) !== "undefined") {
                                localStorage.setItem('deck-' + data, deckPass);
                            }

                            window.location.replace("/decks/" + data);
                        }, 1000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.error(xhr.responseText);
                        $('#deck-create-details-finish').attr('disabled', false);
                    }
                });
            });
        } 
    }
});

function updateDeck(ele, deck, type) {
    var card = {
        cardid: ele.data('card-id'),
        type: ele.data('card-type')
    };
    var num = $('span[data-id="' + card.cardid + '"]');
    var cur_quantity = parseInt(num.text());

    if(type == "minus") {
        if(cur_quantity <= 0 || deck.cards.total <= 0) {
            return;
        } else {
            var index = -1;

            if(card.type == "Character") {
                index = deck.cards.characters.indexOf(card.cardid);

                if(index != -1)
                    deck.cards.characters.splice(index, 1);
            } else if(card.type == "Event") {
                index = deck.cards.events.indexOf(card.cardid);

                if(index != -1)
                    deck.cards.events.splice(index, 1);
            } else if(card.type == "Climax") {
                index = deck.cards.climaxes.indexOf(card.cardid);

                if(index != -1)
                    deck.cards.climaxes.splice(index, 1);
            }

            cur_quantity -= 1;
            deck.cards.total = parseInt(deck.cards.total) - 1;
            num.text(cur_quantity);
        }
    } else if(type == "plus") {
        if(cur_quantity >= 4 || deck.cards.total >= 50) {
            return;
        } else {
            if(card.type == "Character") {
                deck.cards.characters.push(card.cardid);
            } else if(card.type == "Event") {
                deck.cards.events.push(card.cardid);
            } else if(card.type == "Climax") {
                if(deck.cards.climaxes.length < 8) {
                    deck.cards.climaxes.push(card.cardid);
                } else {
                    return;
                }
            }

            cur_quantity += 1;
            deck.cards.total = parseInt(deck.cards.total) + 1;
            num.text(cur_quantity);
        }
    }

    displayCounts(deck);
    updateDeckDisplay(deck);
}

function displayCounts(deck) {
    var charactersTotal = deck.cards.characters.length;
    var eventsTotal = deck.cards.events.length;
    var climaxesTotal = deck.cards.climaxes.length;

    $('.deck-create__info__characters').text(charactersTotal);
    $('.deck-create__info__events').text(eventsTotal);
    $('.deck-create__info__climaxes').text(climaxesTotal);
    $('.deck-create__info__total').text(deck.cards.total);
}

function updateDeckDisplay(deck) {
    clearTimeout(delayTimer);
    delayTimer = setTimeout(function() {
        $.ajax({
            url: '/decks/list',
            type: 'POST',
            data: {
                'cards': deck.cards
            },
            success: function(data, textStatus, xhr) {
                $('.deck-create__deck').html(data);

                $('.deck-create__deck [data-toggle="tooltip"]').tooltip();
            }
        });
    }, 250);
}

function setWarningAlert(str) {
    $('#alert-box').html('<div class="alert alert-warning" role="alert">Error: ' + str + '</div>');
    setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2500);
}

function setPrimaryAlert(str) {
    $('#alert-box').html('<div class="alert alert-success" role="alert">Success: ' + str + '</div>');
    setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 2500);
}

function isValidDate(dateString) {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if(!dateString.match(regEx)) return false;  // Invalid format
    var d = new Date(dateString);
    if(Number.isNaN(d.getTime())) return false; // Invalid date
    return d.toISOString().slice(0,10) === dateString;
  }