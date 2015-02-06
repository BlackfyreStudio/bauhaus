

@if($groupId == 1)
	<div class="alert alert-info" role="alert">{{trans('bauhaus::form.permissions.admin-edit-disabled')}}</div>
	@else
	@foreach(\KraftHaus\BauhausUser\PermissionRegister::all() AS $p)
		<fieldset>
			<legend>{{$p['name']}}</legend>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<div class="row">
						<div class="col-sm-3">
							<div class="checkbox">
								<label>
									{{ Form::checkbox('permissions[]',$p['name'].'.read',isset($permissions[$p['name'].'.read'])) }}
									{{ trans('bauhaus::form.permissions.read') }}
								</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="checkbox">
								<label>
									{{ Form::checkbox('permissions[]',$p['name'].'.create',isset($permissions[$p['name'].'.create'])) }}
									{{ trans('bauhaus::form.permissions.create') }}
								</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="checkbox">
								<label>
									{{ Form::checkbox('permissions[]',$p['name'].'.update',isset($permissions[$p['name'].'.update'])) }}
									{{ trans('bauhaus::form.permissions.update') }}
								</label>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="checkbox">
								<label>
									{{ Form::checkbox('permissions[]',$p['name'].'.delete',isset($permissions[$p['name'].'.delete'])) }}
									{{ trans('bauhaus::form.permissions.delete') }}
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	@endforeach
@endif


