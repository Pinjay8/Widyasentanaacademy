<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0">
        <div class="modal-header">
            <h5 class="modal-title" id="shareModalLabel">Bagikan Campaign</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="input-group">
                <input type="text" class="form-control" id="shareLink"
                    value="{{ route('campaign.index', ['slug' => $campaign->slug]) }}" readonly>
                <button class="btn btn-primary" type="button"
                    onclick="copyShareLink()">Salin</button>
            </div>
            <small class="text-muted mt-2 d-block">Salin link dan bagikan kepada
                teman-temanmu!</small>
        </div>
    </div>
</div>
</div>
