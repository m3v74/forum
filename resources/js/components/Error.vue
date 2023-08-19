<template>
    <!-- Модальное окно -->
    <div  id="errorModal"   class="modal fade"  tabindex="-1"  aria-labelledby="errorModalLabel"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="errorModalLabel">Системное сообщение</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <h4 style="color: white">Ошибка записи в БД</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default
{
    name: "Error",

    data()
    {
        return {
            modal: null
        }
    },

    methods:
    {
       show()
       {
           this.modal.show();
       }
    },

    mounted()
    {
        var errorModal = document.getElementById('errorModal')
        this.modal = bootstrap.Modal.getOrCreateInstance(errorModal);
    }
}


</script>


<style scoped>
.modal-content
{
    background: #9c2f2f;
}

.modal-title
{
    color: white;
}
</style>
