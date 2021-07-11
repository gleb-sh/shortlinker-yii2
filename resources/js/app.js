let YoutDomain = ''

class Ajax
{
    getdata(method,data,success = function(){})
    {
        let getdata = new XMLHttpRequest();

        getdata.open('POST', method,true)
        getdata.setRequestHeader('Content-Type','application/json; charset=utf-8')
        getdata.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'))
        getdata.send( JSON.stringify(data) )
        getdata.onreadystatechange = function() {
            if (getdata.readyState != 4) return;        
            ans = JSON.parse(getdata.responseText)
            console.log(ans)
            succses(ans);
        }
    }
}

document.querySelectorAll('.unical-form').forEach(form=>{
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        e.stopImmediatePropagation;

        let data = {};
        form.querySelectorAll('input').forEach(input=>{
            data[input.name] = input.value;
        });

        form.querySelector('button').classList.add('hidden');
        form.querySelector('input').setAttribute('disabled',true);

        let result = document.querySelector('.unical-result')

        getdata(form.dataset.method,data,(ans)=>{
            if (ans.status === 1) {
                //
                result.classList.add('active');
                result.querySelector('a').innerHTML = YoutDomain + '/' + ans.data.alias;
                result.querySelector('a').setAttribute('href','https://' + YoutDomain + '/' + ans.data.alias)
                                
            } else {
                //
                result.classList.add('error')
                result.querySelector('p').innerHTML = ans.error
            }
        })

        return false;
    })
})

document.querySelectorAll('*[data-copy]').forEach(el=>{
    el.addEventListener('click',()=>{
        console.log(el.dataset.copy);
        let copyTarget = document.querySelector(el.dataset.copy);
        console.log (copyTarget);
        if (copyTarget) {
            //
            var rng, sel;
            rng = document.createRange()
            rng.selectNode(copyTarget)
            sel = window.getSelection();
            sel.removeAllRanges;
            sel.addRange(rng);
            //
            document.execCommand('copy');
            let oldText = el.innerHTML
            el.innerHTML = 'Скопированно'
            el.classList.add('success-copy')
            setTimeout(() => {
                el.innerHTML = oldText
                el.classList.remove('success-copy')
            }, 3000);
        }
    })
})