<div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
        <div class="rounded-t mb-0 px-4 py-3 border-0">
            <div class="flex flex-wrap items-center">
                <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-blueGray-700">Zamówienia</h3>
                </div>
            </div>
        </div>

        <div class="block w-full overflow-x-auto">
            <table class="items-center bg-transparent w-full border-collapse ">
                <thead>
                    <tr class="bg-[#efefef]">
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            #
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            ID
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Status
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Total price
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Payment status
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Created at
                        </th>
                        <th class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                            Options
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($params['data'] ?? [] as $index => $data): ?>
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center text-blueGray-700 ">
                                <?php echo $index ?>
                            </th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                <?php echo $data['id'] ?>
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                <?php echo $data['status'] ?>
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                <?php echo $data['total_price'] ?>
                            </td>
                            <td class="border-t-0 px-6 align-center border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                <span class="font-medium m-auto block w-[70px] p-1 
                                <?php
                                    if($data['payment_status'] === 'completed'){
                                        echo "bg-emerald-500";
                                    }elseif($data['payment_status'] === 'pending'){
                                        echo "bg-amber-500";
                                    }else {
                                        echo "bg-red-500";
                                    }
                                ?>
                                "><?php echo $data['payment_status'] ?></span>
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center">
                                <i class="fa-solid fa-clock text-emerald-500 mr-4"></i>
                                <?php echo $data['created_at'] ?>
                            </td>
                            <td class="flex gap-2 border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-center text-lg">
                                <a href="" class="text-sm text-slate-700 hover:text-slate-500"><i class="fa-solid fa-pencil"></i></a>
                                <a href="/?module=order&page=show&id=<?= $data['id'] ?>" class="text-sm text-slate-700 hover:text-slate-500"><i class="fa-solid fa-eye"></i></a>
                                <a href="" class="text-sm text-slate-700 hover:text-slate-500"><i class="fa-solid fa-minus"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>
    </div>
</div>