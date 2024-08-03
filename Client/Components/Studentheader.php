<nav
    class="relative flex w-full items-center justify-between bg-gray-200 py-2 shadow-dark-mild dark:bg-body-dark lg:flex-wrap lg:justify-start lg:py-4"
    data-twe-navbar-ref>
    <div class="flex w-full flex-wrap items-center justify-between px-3">
      <div
        class="!visible hidden grow basis-[100%] items-center text-center lg:!flex lg:basis-auto lg:text-left"
        id="navbarSupportedContentY"
        data-twe-collapse-item>
        <ul
          class="me-auto flex flex-col lg:flex-row"
          data-twe-navbar-nav-ref>
          <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
            <a
              class="block text-black/60 transition duration-200 hover:text-black/80 hover:bg-gray-300 focus:text-black/80 active:text-black/80 motion-reduce:transition-none dark:text-white/60 dark:hover:text-white/80 dark:focus:text-white/80 dark:active:text-white/80 lg:px-2"
              href="#"
              data-twe-nav-link-ref
              data-twe-ripple-init
              data-twe-ripple-color="light"
              >Home</a>
          </li>
          <li class="mb-4 lg:mb-0 lg:pe-2" data-twe-nav-item-ref>
            <form action="utils/logOut.php" method="post" class="inline">
              <button type="submit" class="block text-red-600 transition duration-200 hover:text-red-800 hover:bg-gray-300 focus:text-red-800 active:text-red-800 motion-reduce:transition-none dark:text-red-400 dark:hover:text-red-600 dark:focus:text-red-600 dark:active:text-red-600 lg:px-2">
                Log Out
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
</nav>
