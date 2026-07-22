<section
    x-data="{ visible: false }"
    x-intersect="visible = true"
    :class="visible ? 'transition-section--visible' : ''"
    class="transition-section"
    >
    <div class="container mx-auto md:mt-12 mt-8">
        <div class="grid grid-cols-12 md:gap-x-12 items-center">
            <div class="col-span-12 md:col-span-5 order-2 md:order-1">
                <div class="max-w-[300px] md:max-w-none mx-auto">
                    <img class="h-auto w-full" src="http://localhost:10014/wp-content/uploads/2026/02/alex_image.png" alt="AJM Golf Image" class="w-full rounded-md object-cover">
                </div>
            </div>
            <div class="col-span-12 md:col-span-7 order-1 md:order-2">
                <div class="prose text-center md:text-start">
                    <h3>“EVERY GOLFER LEARNS DIFFERENTLY. IT IS ESSENTIAL TO BE ABLE TO ASSESS A PLAYER IN A NUMBER OF WAYS SO THAT TOGETHER WE CAN FIND THE CORRECT SOLUTION. ”</h3>
                    <p>I am a PGA Professional based in the city ofs Bristol in England. After playing to a good standard of amateur golf including at college level I 
                        decided to turn Professional at the age of 19. Although I still compete when possible I dedicate the majority of my time to developing my 
                        coaching skill set. This enables me to provide an exceptional learning experience for all my clients which allows the individual to 
                        quickly develop their golfing skills.</p>
                </div>
            </div>
        </div>
    </div>
</section>