<div>
    @if($tipType === 'amount')
    <div class="tip-amount">
        <label for="tip_amount">Tip Amount</label>
        <select id="tip_amount" wire:change="setTipAmount($event.target.value)">
            @for ($i = 0; $i <= 8; $i += 0.5)
                <option value="{{ $i }}" {{ $tipAmount == $i ? 'selected' : '' }}>
                    {{ number_format($i, 2) }} €
                </option>
            @endfor
        </select>
    </div>
    @elseif($tipType === 'percentage')
        <div class="dropdown tip">
            <a href="#" data-bs-toggle="dropdown">
                Tip: <span id="selected_tip">{{ $tipPercentage ? $tipPercentage . '%' : '' }}</span>
            </a>
            <div class="dropdown-menu">
                <div class="dropdown-menu-content">
                    <h4>Select Tip Percentage</h4>
                    <div class="radio_select add_bottom_15">
                        <ul>
                            <li>
                                <input type="radio" id="tip_5" name="tip" value="5" wire:click="setTipPercentage(5)">
                                <label for="tip_5">5%</label>
                            </li>
                            <li>
                                <input type="radio" id="tip_10" name="tip" value="10" wire:click="setTipPercentage(10)">
                                <label for="tip_10">10%</label>
                            </li>
                            <li>
                                <input type="radio" id="tip_15" name="tip" value="15" wire:click="setTipPercentage(15)">
                                <label for="tip_15">15%</label>
                            </li>
                            <li>
                                <input type="radio" id="tip_20" name="tip" value="20" wire:click="setTipPercentage(20)">
                                <label for="tip_20">20%</label>
                            </li>
                        </ul>
                        <button wire:click="resetTip" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .tip-amount, .tip-percentage {
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .tip-amount {
            display: flex;
            flex-direction: column;
        }

        .tip-amount label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        .tip-amount select {
            padding: 5px;
            border: 1px solid #c8c8c8;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .dropdown.tip {
            margin-top: 10px;
            border: 1px dotted #c8c8c8;
            padding: 0;
            margin-bottom: 10px;
        }

        .dropdown-menu-content {
            padding: 10px;
        }

        .radio_select ul {
            list-style: none;
            padding: 0;
        }

        .radio_select li {
            margin-bottom: 10px;
        }

        .radio_select input[type="radio"] {
            margin-right: 10px;
        }

        .radio_select label {
            font-weight: normal;
        }

        .btn {
            margin-top: 10px;
        }
    </style>
</div>
