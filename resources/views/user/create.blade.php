<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10  bg-white rounded-lg shadow-xl mt-10 md:mt-0" >
        <form action="{{ route('user.store') }}" method="POST" novalidate>
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
                <lable for="email" class="mb-2 block uppercase text-gray-500 font-bold">email</lable>
                <input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="password" class="mb-2 block uppercase text-gray-500 font-bold">password</lable>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">password_confirmation</lable>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="username" class="mb-2 block uppercase text-gray-500 font-bold">username</lable>
                <input
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="last_name" class="mb-2 block uppercase text-gray-500 font-bold">last_name</lable>
                <input
                    id="last_name"
                    name="last_name"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="phone_number" class="mb-2 block uppercase text-gray-500 font-bold">phone_number</lable>
                <input
                    id="phone_number"
                    name="phone_number"
                    type="phone"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="estatus" class="mb-2 block uppercase text-gray-500 font-bold">estatus</lable>
                <input
                    id="estatus"
                    name="estatus"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="rol" class="mb-2 block uppercase text-gray-500 font-bold">rol</lable>
                <input
                    id="rol"
                    name="rol"
                    type="text"
                    placeholder="Titulo de la publicacion"
                    class="border p-3 w-full rounded-lg"                />
            </div>

            <div class="mb-5">
                <lable for="picture" class="mb-2 block uppercase text-gray-500 font-bold">rol</lable>
                <input
                    id="picture"
                    name="picture"
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