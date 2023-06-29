<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search nice-select-white">
					<form method="get" action="{{ route('search') }}">
                        @csrf
                        <div class="form-row">
                            {{-- <div class="form-group col-xl-4 col-lg-3 col-md-6">
                                <input name="text" disabled type="text" class="my-2 form-control my-lg-1" id="inputtext4"
                                    placeholder="Que recherchez-vous ?">
                            </div> --}}
                            <div class="form-group col-lg-4 col-md-6">
                                <select name="category_id" class="w-100 form-control mt-lg-1 mt-md-2">
                                    <option selected disabled>Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == Request::query('category_id') ? 'selected' : ''}}>{{ $category->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-md-6">
                                <select name="ville_id" class="w-100 form-control mt-lg-1 mt-md-2">
                                    <option selected disabled>Provinces</option>
                                    @foreach ($villes as $ville)
                                        <option value="{{ $ville->id }}" {{ $ville->id == Request::query('ville_id') ? 'selected' : '' }}>{{ $ville->nom }}</option>
                                    @endforeach
                                </select>										</div>
                            <div class="form-group col-xl-2 col-lg-3 col-md-6 align-self-center">
                                <button type="submit" class="btn btn-primary active w-100">Rechercher</button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</section>
