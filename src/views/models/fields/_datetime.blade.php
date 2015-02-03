<div class="form-group {{ $errors->has($field->getName()) ? 'has-error' : '' }}">
	<label class="col-sm-3 control-label">{{ $field->getLabel() }}</label>
	<div class="col-sm-9">
		<div class="input-group date field-datetime" data-date-format="YYYY-MM-DD HH:mm:ss">
			{{ Form::text($field->getName(), $field->getValue(), $field->getAttributes()) }}
			<span class="input-group-addon">
				<i class="fa fa-calendar"></i>
			</span>
		</div>

		@if ($field->getDescription())
			<p class="help-block">{{ $field->getDescription() }}</p>
		@endif
	</div>
</div>
