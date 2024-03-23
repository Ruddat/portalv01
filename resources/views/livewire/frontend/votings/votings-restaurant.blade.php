<div>
	<main class="bg_gray">

		<div class="container margin_60_20">
		    <div class="row justify-content-center">
		        <div class="col-lg-8">
		            <div class="box_general write_review">
                        <form wire:submit.prevent="submitReview">
		                <h1 class="add_bottom_15">Write a review for "{{ $restaurant->title }} {{ $order->order_nr }}"</h1>
		                <label class="d-block add_bottom_15">Overall rating</label>
		                <div class="row">
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Food Quality <strong id="food_quality_val">{{ $food_quality_val }}</strong></div>
                                <input type="range" min="0" max="10" step="1" wire:model="food_quality_val" id="food_quality">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Service <strong id="service_val">{{ $service_val }}</strong></div>
                                <input type="range" min="0" max="10" step="1" wire:model="service_val" id="service">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Delivery Time <strong id="delivery_time_val">{{ $delivery_time_val }}</strong></div>
                                <input type="range" min="0" max="10" step="1" wire:model="delivery_time_val" id="delivery">
                            </div>
                            <div class="col-md-3 add_bottom_25">
                                <div class="add_bottom_15">Price <strong id="price_val">{{ $price_val }}</strong></div>
                                <input type="range" min="0" max="10" step="1" wire:model="price_val" id="price">
                            </div>
		                </div>
                        <div class="form-group">
                            <label>Title of your review</label>
                            <input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?" wire:model="review_title">
                            @error('review_title') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Your review</label>
                            <textarea class="form-control" style="height: 180px;" placeholder="Write your review to help others learn about this online business" wire:model="review_content"></textarea>
                            @error('review_content') <span class="error">{{ $message }}</span> @enderror
                        </div>
		                <div class="form-group">
		                    <label>Add your photo (optional)</label>
		                    <div class="fileupload"><input type="file" name="fileupload" accept="image/*"></div>
		                </div>
                        <div class="form-group">
                            <div class="checkboxes float-start add_bottom_15 add_top_15">
                                <label class="container_check">
                                    Eos tollit ancillae ea, lorem consulatu qui ne, eu eros eirmod scaevola sea. Et nec tantas accusamus salutatus, sit commodo veritus te, erat legere fabulas has ut. Rebum laudem cum ea, ius essent fuisset ut. Viderer petentium cu his.
                                    <input type="checkbox" wire:model="agb_accepted">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            @error('agb_accepted') <span class="error">{{ $message }}</span> @enderror
                        </div>
		                <button type="submit" class="btn_1">Submit review</button>
                    </form>

		            </div>
		        </div>
		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->

	</main>
	<!-- /main -->
</div>


<script>

    // Range slider value display for Quality
    document.getElementById('food_quality').addEventListener('input', function() {
    document.getElementById('food_quality_val').innerText = this.value;
    });

    // Range slider value display for Service
    document.getElementById('service').addEventListener('input', function() {
        document.getElementById('service_val').innerText = this.value;
    });

    // Range slider value display for Punctuality
    document.getElementById('delivery').addEventListener('input', function() {
        document.getElementById('delivery_time_val').innerText = this.value;
    });

    // Range slider value display for Price
    document.getElementById('price').addEventListener('input', function() {
        document.getElementById('price_val').innerText = this.value;
    });
</script>
