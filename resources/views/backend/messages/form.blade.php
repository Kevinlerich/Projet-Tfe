
<div class="form-group">
    <label for="sender">{{ __('messages.sender') }}</label>
    <input type="text" class="form-control" name="expediteur_id" value="{{ $message->expediteur->nom }}" readonly>
</div>

<div class="form-group">
    <label for="contenue">{{ __('messages.content') }}</label>
    <textarea name="contenue" id="contenue" cols="2" rows="2" class="form-control">
        {{ old('contenue', optional($message)->contenue) }}
    </textarea>
</div>
