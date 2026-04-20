import { db } from '@/db';
import { deceased, graves, blocks } from '@/db/schema';
import { NextResponse } from 'next/server';
import { eq } from 'drizzle-orm';

export async function GET(request: Request) {
  try {
    const { searchParams } = new URL(request.url);
    const search = searchParams.get('search');

    const allDeceased = await db.select({
      id: deceased.id,
      graveId: deceased.graveId,
      fullName: deceased.fullName,
      birthDate: deceased.birthDate,
      deathDate: deceased.deathDate,
      age: deceased.age,
      biography: deceased.biography,
      photo: deceased.photo,
      plotNumber: graves.plotNumber,
      blockName: blocks.name,
    })
    .from(deceased)
    .leftJoin(graves, eq(deceased.graveId, graves.id))
    .leftJoin(blocks, eq(graves.blockId, blocks.id));

    return NextResponse.json(allDeceased);
  } catch (error) {
    console.error('Error fetching deceased:', error);
    return NextResponse.json({ error: 'Failed to fetch deceased' }, { status: 500 });
  }
}

export async function POST(request: Request) {
  try {
    const body = await request.json();
    const { graveId, fullName, birthDate, deathDate, age, biography, photo } = body;

    // Update grave status
    await db.update(graves)
      .set({ status: 'occupied' })
      .where(eq(graves.id, graveId));

    const newDeceased = await db.insert(deceased).values({
      graveId,
      fullName,
      birthDate,
      deathDate,
      age,
      biography,
      photo,
    }).returning();

    return NextResponse.json(newDeceased[0]);
  } catch (error) {
    console.error('Error creating deceased record:', error);
    return NextResponse.json({ error: 'Failed to create deceased record' }, { status: 500 });
  }
}
