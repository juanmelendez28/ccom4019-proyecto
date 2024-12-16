<div id="confirmLogoutModal" class="modal">
    <div class="modal-content">
        <div class="modal-wrapper">
            <i class="las la-exclamation-triangle"></i>
            <h2>Are you sure you want to exit?</h2>
            <div class="modal-actions">
                <a onclick="closeModal('confirmLogoutModal')" href="#" type="submit" class="action secondary-negative"> <i class="las la-times"></i> Cancel</a>
                <form action="?logout" method="POST">
                    <div class="action-group">
                        <input type="hidden" name="logout" value="true">
                        <input class="action primary-negative" type="submit" value="Exit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>