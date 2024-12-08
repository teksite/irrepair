const langFa={
    "delete":"حذف",
    "are sure to delete this item?":"از حذف این مورد مطمن هستید؟",
    "warning":"هشدار",
    "cansel":"کنسل",
    "yes":"بله"

}

export  default function trans(item){
    let langSite=document.documentElement.lang

    if(langSite === 'fa'){
        return langFa[item] ?? item;
    }else {
        return  item;
    }
}
