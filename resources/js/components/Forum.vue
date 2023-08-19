<template>

    <button class="btn btn-info" @click="addCategory">Добавить категорию</button>
    <div v-for="(h, indexHome) in homeCategory">
        <div style="margin-top: 20px">
            <div class="AllNewsAutorID  shadow rounded">
                <ul>
                    <li class="categories" v-for="(c, indexChild) in h">
                        <div class="element">
                            <img :src="c.image" width="30" height="30" alt="">
                            <div style="margin: 0 0 20px 10px"><a href="" @click="getCategory($event, indexHome, indexChild)">{{ c.name }}</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCategoryModalLabel">Добавление категории</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <label for="parent">Создать родительскую категорию</label>
                    <input type="checkbox" class="form-check" id="parent" v-model="parent">

                    <label for="parent_category" v-show="!parent">Выберите родительскую категорию</label>
                    <select id="parent_category" class="form-select" v-show="!parent" v-model="selectedCategory">
                        <option v-for="(c, i) in allCategory" :value="c.id">{{ c.name }}</option>
                    </select>

                    <label for="name_category">Введите имя категории</label>
                    <input type="text" id="name_category" class="form-control" v-model="nameNewCategory">

                    <label for="upload">Введите имя категории</label>
                    <input type="file" id="upload" ref="upload" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" @click="saveCategory">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            homeCategory: [],
            addCategoryModal: null,
            allCategory: [],
            selectedCategory: '',
            nameNewCategory: '',
            parent: false
        }
    },
    methods: {
        async saveCategory() {
            var formData = new FormData();
            formData.append("id",  this.parent === false ? this.selectedCategory : null);
            formData.append("name", this.nameNewCategory);
            formData.append('file', this.$refs.upload.files[0])

            var requestOptions = {
                method: 'POST',
                body: formData,
                redirect: 'follow'
            };

            var response = await fetch("api/category/save", requestOptions);
            if (response.ok) {
                this.addCategoryModal.hide();
                this.homeCategory = [];
                this.home();
            }
        },
        addCategory() {
            this.getAllCategory();
            this.addCategoryModal.show();
        },
        async getAllCategory() {
            var requestOptions = {
                method: 'POST',
                redirect: 'follow'
            };

            var response = await fetch("api/category/all", requestOptions);
            if (response.ok) {
                this.allCategory = await response.json();
            }
        },
        async home() {
            var requestOptions =
                {
                    method: 'POST',
                    redirect: 'follow'
                };
            var response = await fetch("api/home", requestOptions);
            var homeCategory = await response.json();
            this.homeCategory.push(homeCategory);
        },
        async getCategory(e, indexHome, indexChild) {
            e.preventDefault();

            var parent_id = this.homeCategory[indexHome][indexChild].id;

            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            var urlencoded = new URLSearchParams();
            urlencoded.append("parent_id", parent_id);

            var requestOptions =
                {
                    method: 'POST',
                    headers: myHeaders,
                    body: urlencoded,
                    redirect: 'follow'
                };

            var response = await fetch("api/category", requestOptions);
            var childCategory = await response.json();
            if (this.homeCategory.length > 1) {
                this.homeCategory.pop();
            }
            this.homeCategory.push(childCategory);
        },
    },
    mounted() {
        var addCategoryModal = document.getElementById('addCategoryModal')
        this.addCategoryModal = bootstrap.Modal.getOrCreateInstance(addCategoryModal);

        this.home();
    }
}

</script>

<style scoped lang="scss">

.categories {
    display: flex;

    .element {
        display: flex;
        margin-top: 10px;
    }
}

.main {
    display: flex;
    gap: 20px;
}

.news {
    overflow: hidden;
    border: 2px solid black;
    border-radius: 10px;
    width: 430px;
}

.AllNewsAutorID {
    width: 558px;
}

.author {
    overflow: hidden;
    border: 2px solid black;
    border-radius: 10px;
    width: 390px;
}

td {
    border-bottom: 1px solid black;
    padding: 7px;
    vertical-align: middle;
}

tr:last-child > td {
    border: none;
}

.ico {
    margin-right: 14px;
    font-size: 20px;
    cursor: pointer;
}

.img {
    border-radius: 5px;
    overflow: hidden;
}

.btn {
    margin-top: 20px
}


</style>
