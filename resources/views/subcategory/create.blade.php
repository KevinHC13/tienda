<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0" >
        <form action="{{ route('subcategory.store') }}" method="POST" novalidate>
            @csrf
            <div class="mb-5">
                <lable for="name" class="mb-2 block uppercase text-gray-500 font-bold">name</lable>
                <input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="code" class="mb-2 block uppercase text-gray-500 font-bold">code</lable>
                <input
                    id="code"
                    name="code"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="description" class="mb-2 block uppercase text-gray-500 font-bold">description</lable>
                <input
                    id="description"
                    name="description"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="user_id" class="mb-2 block uppercase text-gray-500 font-bold">user_id</lable>
                <input
                    id="user_id"
                    name="user_id"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="category_id" class="mb-2 block uppercase text-gray-500 font-bold">category_id</lable>
                <input
                    id="category_id"
                    name="category_id"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <input
                type="submit"
                value="Publicar"
                class="bg-sky-600  mb-4 hover:bg-sky700 transition-colors cursor-pointer upper
                 font-bold w-full p-3 text-white rounded-lg"
            />
        </form>
    </div>

</div>