<!-- Modal -->
<div class="modal fade" id="updateAvatar" data-modal="update-avatar" tabindex="-1" role="dialog" aria-labelledby="updateAvatarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="{{ route('client.settings.profile.me.updateAvatar') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateAvatarLabel">Cập nhật ảnh đại diện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="avatar-preview">
                        <div class="row no-gutters">
                            <input type="hidden" name="avatar" data-form-avatar-value="{{ $student->avatar }}" value="{{ $student->avatar }}">
                            @foreach (ListHelper::getAvatarList() as $avatar)
                                <div class="col-md-3 p-1">
                                    <div class="avatar-preview__item {{ $student->avatar === $avatar ? 'active' : '' }}" data-selection="avatar" data-avatar="{{ $avatar }}">
                                        <img src="{{ avatar_cute_path($avatar) }}" alt="Avatar very cute">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>
