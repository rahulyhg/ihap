<?php 
/**
* @package Jabali Framework
* @subpackage Home
* @link https://docs.mauko.co.ke/jabali/home
* @author Mauko Maunde
* @version 0.17.06
**/

include 'header.php'; ?>
<title>Tables [ <?php getOption( 'name' ); ?> ]</title>
<style>
div.mdl-card {
  margin: 0 auto;
}

div.mdl-card__supporting-text {
  font-size: 1.2em;
}

/* Table Sorting */
input + table {
  margin-top: 1em;
}

$sortIndicatorIconColor: #000;
th.sort {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;

  min-width: 75px; // th "Year" is too small and sort icon needs extra room

  &:hover {
    cursor: pointer;
    text-decoration: none;
  }

  &:focus {
    outline:none;
  }

  &:after {
    display:inline-block;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid transparent;
    content:"";
    position: relative;
    top:-10px;
    right:-5px;
  }
  &.asc:after {
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 5px solid $sortIndicatorIconColor;
    content:"";
    position: relative;
    top:4px;
    right:-5px;
  }
  &.desc:after {
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid $sortIndicatorIconColor;
    content:"";
    position: relative;
    top:-4px;
    right:-5px;
  }

}
</style>
<script>
var options = {
        valueNames: ['material', 'quantity', 'price']
    }
  , documentTable = new List('mdl-table', options)
  ;


$( $('th.sort' )[0] ).trigger('click', function () {
  console.log('clicked' );
} );

$('input.search' ).on('keyup', function (e) {
  if ( e.keyCode === 27) {
    $(e.currentTarget).val('' );
    documentTable.search('' );
  }
} );
</script>
<div class="mdl-grid">
<div class="mdl-cell mdl-cell--12-col">
    <div class="mdl-card mdl-shadow--2dp mdl-color--green-300">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">MDL-Table</h2>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <div id="mdl-table">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable is-upgraded is-focused">
                    <label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
                        <i class="material-icons">search</i>
                    </label>
                    <div class="mdl-textfield__expandable-holder">
                        <input class="mdl-textfield__input search" type="text" id="sample6">
                        <label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
                    </div>
                </div>

                <table id='mdl-table' class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--2dp">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric sort" data-sort="material">Material</th>
                            <th class="sort" data-sort="quantity">Quantity</th>
                            <th class="sort" data-sort="price">Unit price</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric material">Acrylic (Transparent)</td>
                            <td class="quantity">25</td>
                            <td class="price">$2.90</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric material">Plywood (Birch)</td>
                            <td class="quantity">35</td>
                            <td class="price">$1.25</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric material">Laminate (Gold on Blue)</td>
                            <td class="quantity">10</td>
                            <td class="price">$2.35</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric material">Bamboo (Gold on Blue)</td>
                            <td class="quantity">1</td>
                            <td class="price">$13.15</td>
                        </tr>
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric material">Tile (Gold on Blue)</td>
                            <td class="quantity">12</td>
                            <td class="price">$5.35</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>  
<?php 
include 'footer.php';
?>